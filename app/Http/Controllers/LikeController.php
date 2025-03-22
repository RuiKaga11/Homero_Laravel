<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // いいね追加
    public function store(Request $request, $tweetId)
    {
        $tweet = Tweet::findOrFail($tweetId);
        
        // すでにいいねしていないか確認
        $existing = Like::where('user_id', Auth::id())
            ->where('tweet_id', $tweetId)
            ->first();
            
        if (!$existing) {
            Like::create([
                'user_id' => Auth::id(),
                'tweet_id' => $tweetId
            ]);
        }
        
        // いいねの総数を取得
        $likesCount = $tweet->likes()->count();
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'likes_count' => $likesCount,
                'status' => 'success'
            ]);
        }
        
        return back();
    }

    // いいね削除
    public function destroy(Request $request, $tweetId)
    {
        $tweet = Tweet::findOrFail($tweetId);
        
        Like::where('user_id', Auth::id())
            ->where('tweet_id', $tweetId)
            ->delete();
        
        // いいねの総数を取得
        $likesCount = $tweet->likes()->count();
            
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'likes_count' => $likesCount,
                'status' => 'success'
            ]);
        }
        
        return back();
    }
} 