<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Storage;
use App\Models\Tweet;

class UserController extends Controller
{
    /**
     * ログインの可否
     */
    public function index()
    {
        // @dd('dd');
        return view('users.index');
        //
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // @dd($credentials);
        $results = User::where($credentials)->get();
        // @dd($results);
        if(!is_null($results)){
            // 入力された値がDBに登録済みである
            $request->session()->regenerate();
            return redirect()->route('tweets.index');
        }else{

        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    /**
     * アカウントの作成
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('users/' . $user->id . '/profile', 'public');
            $user->profile_image = $path;
            $user->save();
        }

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $tweets = $user->tweets()->withBasicRelations()->latest()->paginate(10);
        
        // 非ログイン時はInstagramスタイルのポップアップ表示
        if (!Auth::check()) {
            return view('users.profile-popup', compact('user', 'tweets'));
        }
        
        return view('users.show', compact('user', 'tweets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user)
    {
        // 自分以外のユーザーの編集は許可しない
        if (Auth::id() != $user) {
            return redirect()->route('tweets.index')
                ->with('error', '他のユーザーのプロフィールは編集できません');
        }
        
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user)
    {
        // 自分以外のユーザーの更新は許可しない
        if (Auth::id() != $user) {
            return redirect()->route('tweets.index')
                ->with('error', '他のユーザーのプロフィールは更新できません');
        }
        
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('profile_image')) {
            // 古い画像を削除
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            
            // ユーザーIDごとのディレクトリに保存
            $path = $request->file('profile_image')->store('users/' . $user->id . '/profile', 'public');
            $user->profile_image = $path;
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete()
    {
        return view('users.confirm-delete');
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/');
    }

    /**
     * ユーザーのツイートを無限スクロールで読み込む
     */
    public function loadMoreTweets(Request $request, $id)
    {
        $page = $request->input('page', 1);
        $user = User::findOrFail($id);
        
        $tweets = $user->tweets()
                    ->withBasicRelations()
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
}
