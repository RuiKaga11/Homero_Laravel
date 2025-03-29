<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;



class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ログインセッションがなければ、welcomeページに遷移
        if(!auth()->check()){
            return view('welcome');
        }
        //　ツイート全件取得
        $tweets = Tweet::with('user')->get();
        $tweet_infos = $tweets->map(function ($tweet) {
            return [
                'user_name' => $tweet->user->name,
                'content' => $tweet->content,
                'created_at' => $tweet->created_at,
                'liked_count' => $tweet->liked_count,
                'category' => $tweet->category->name
            ];
        });

        $categories = Category::all();
        return view('startpage.Tweet', compact('tweet_infos','categories'));
        // return view('startpage.Tweet', compact('tweets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //ツイートを作成する機能
        $validated = $request->validate([
            'user_id' => ['required', 'int', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string', 'max:255'],
        ]);
        Auth::user()->tweets()->create($validated);

        return redirect()->route('tweets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
