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
        $tweets = Tweet::with(['user', 'category', 'likes'])->latest()->get();

        $tweet_infos = $tweets->map(function ($tweet) {
            $data = [
                'id' => $tweet->id,
                'user_id' => $tweet->user_id,
                'user_name' => $tweet->user->name,
                'user_profile_image' => $tweet->user->profile_image,
                'content' => $tweet->content,
                'created_at' => $tweet->created_at,
                'liked_count' => $tweet->likes->count(),
                'category' => $tweet->category->name
            ];
            
            // ログインしている場合は、現在のユーザーがいいねしているかどうかの情報を追加
            if (Auth::check()) {
                $data['user_has_liked'] = $tweet->likes->contains('user_id', Auth::id());
            }
            
            return $data;
        });

        return view('startpage.Tweet', compact('tweet_infos'));
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
        $tweet = Tweet::with(['user', 'category'])->findOrFail($id);
        return view('tweets.show', compact('tweet'));
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
        
        $tweet->delete();
        
        // リファラー（前のページ）をチェックし、そこに戻る
        $referer = $request->headers->get('referer');
        return redirect($referer);
    }

    // ツイート一覧表示（ログイン後）
    public function feed()
    {
        $tweets = Tweet::with(['user', 'category', 'likes'])
            ->latest()
            ->get();
            
        $user = Auth::user();
        
        return view('tweets.feed', compact('tweets', 'user'));
    }
}
