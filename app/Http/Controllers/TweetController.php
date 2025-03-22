<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 非ログイン時は最新10件のみを表示し、ページネーションなし
        if (!auth()->check()) {
            $tweets = Tweet::withBasicRelations()
                        ->latest()
                        ->take(10)
                        ->get();
            return view('welcome', compact('tweets'));
        }
        
        // ログイン済みの場合はfeedメソッドにリダイレクト
        return redirect()->route('tweets.feed');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('tweets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        Auth::user()->tweets()->create($validated);

        return redirect()->route('tweets.feed');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tweet = Tweet::withBasicRelations()
                    ->findOrFail($id);
        
        $responses = $tweet->responseTweets()
                    ->withBasicRelations()
                    ->latest()
                    ->get();
        
        return view('tweets.show', compact('tweet', 'responses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tweet = Tweet::findOrFail($id);
        
        // 自分のツイートのみ編集可能
        if (Auth::id() !== $tweet->user_id) {
            return redirect()->route('tweets.feed')
                ->with('error', '他のユーザーのツイートは編集できません');
        }
        
        $categories = Category::all();
        return view('tweets.edit', compact('tweet', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tweet = Tweet::findOrFail($id);
        
        // 自分のツイートのみ更新可能
        if (Auth::id() !== $tweet->user_id) {
            return redirect()->route('tweets.feed')
                ->with('error', '他のユーザーのツイートは編集できません');
        }
        
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $tweet->update($validated);

        // このツイートが返信の場合、元のツイート詳細ページにリダイレクト
        $respondedToTweet = $tweet->respondedToTweets()->first();
        if ($respondedToTweet) {
            return redirect()->route('tweets.show', $respondedToTweet->id);
        }

        return redirect()->route('tweets.feed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $tweet = Tweet::findOrFail($id);
        
        // 自分のツイートのみ削除可能
        if (Auth::id() !== $tweet->user_id) {
            return redirect()->route('tweets.index')
                ->with('error', '他のユーザーのツイートは削除できません');
        }
        
        // このツイートが返信の場合は、元のツイートIDを取得
        $originalTweetId = null;
        $respondedToTweet = $tweet->respondedToTweets()->first();
        if ($respondedToTweet) {
            $originalTweetId = $respondedToTweet->id;
        }
        
        $tweet->delete();
        
        // 返信だった場合は元のツイート詳細ページに戻る
        if ($originalTweetId) {
            return redirect()->route('tweets.show', $originalTweetId);
        }
        
        // それ以外の場合はリファラーに戻る
        $referer = $request->headers->get('referer');
        return redirect($referer);
    }

    /**
     * Display feed of tweets.
     */
    public function feed()
    {
        $user = Auth::user();
        $tweets = Tweet::withBasicRelations()
                    ->latest()
                    ->paginate(10);
                    
        return view('tweets.feed', compact('tweets', 'user'));
    }

    /**
     * 返信の保存
     */
    public function response(Request $request, $id)
    {
        $tweet = Tweet::findOrFail($id);
        
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:255'],
        ]);
        
        // 新しいツイートを作成
        $responseTweet = new Tweet();
        $responseTweet->user_id = Auth::id();
        $responseTweet->content = $validated['content'];
        $responseTweet->category_id = $tweet->category_id;
        $responseTweet->save();
        
        // 中間テーブルに関連を保存
        $tweet->responseTweets()->attach($responseTweet->id);
        
        return redirect()->route('tweets.show', $tweet->id);
    }

    /**
     * ページネーション用のツイートをJSONで返す
     */
    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        
        // 1回のロードで15件に変更（現在は10件）
        $tweets = Tweet::withBasicRelations()
                    ->latest()
                    ->paginate(15, ['*'], 'page', $page);
        
        $html = '';
        foreach ($tweets as $tweet) {
            $html .= view('components.tweet-card', [
                'tweet' => $tweet,
                'showControls' => auth()->check() && auth()->id() === $tweet->user_id
            ])->render();
        }
        
        return response()->json([
            'html' => $html,
            'nextPage' => $tweets->hasMorePages() ? $page + 1 : null,
        ]);
    }

    /**
     * ツイート詳細ページの返信を無限スクロールで読み込む
     */
    public function loadMoreResponses(Request $request, $id)
    {
        $page = $request->input('page', 1);
        $tweet = Tweet::findOrFail($id);
        
        $responses = $tweet->responseTweets()
                    ->withBasicRelations()
                    ->latest()
                    ->paginate(15, ['*'], 'page', $page);
        
        $html = '';
        foreach ($responses as $response) {
            $html .= view('components.tweet-card', [
                'tweet' => $response,
                'showControls' => auth()->check() && auth()->id() === $response->user_id
            ])->render();
        }
        
        return response()->json([
            'html' => $html,
            'nextPage' => $responses->hasMorePages() ? $page + 1 : null,
        ]);
    }
}
