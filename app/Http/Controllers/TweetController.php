<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\user;


class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $foreginTweetUser = Tweet::orderBy('created_at', 'asc')->paginate(10);
        $tweets = Tweet::with('user')->get();

        // $tweetInfos = [];
        //username,content
        $tweet_infos = $tweets->map(function ($tweet) {
            return [
                'user_name' => $tweet->user->name,
                'content' => $tweet->content,
                'created_at' => $tweet->created_at,
                'liked_count' => $tweet->liked_count,
                'category' => $tweet->category->name
            ];
        });

        return view('startpage.Tweet', compact('tweet_infos'));
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
        //
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
