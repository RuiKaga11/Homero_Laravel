<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * ユーザーをフォロー
     */
    public function follow(User $user)
    {
        // 自分自身をフォローできないようにする
        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', '自分自身をフォローすることはできません');
        }

        // すでにフォローしている場合は何もしない
        if (Auth::user()->isFollowing($user)) {
            return redirect()->back()->with('error', 'すでにフォローしています');
        }

        // フォロー関係を作成
        Auth::user()->follows()->attach($user->id);

        return redirect()->back();
    }

    /**
     * ユーザーのフォローを解除
     */
    public function unfollow(User $user)
    {
        // フォローしていない場合は何もしない
        if (!Auth::user()->isFollowing($user)) {
            return redirect()->back()->with('error', 'フォローしていません');
        }

        // フォロー関係を削除
        Auth::user()->follows()->detach($user->id);

        return redirect()->back();
    }

    /**
     * フォロー中のユーザー一覧を表示
     */
    public function following(User $user)
    {
        $follows = $user->follows()->paginate(20);
        $title = $user->name . 'がフォロー中';
        
        return view('users.follows', compact('user', 'follows', 'title'));
    }

    /**
     * フォロワー一覧を表示
     */
    public function followers(User $user)
    {
        $followers = $user->followers()->paginate(20);
        $title = $user->name . 'のフォロワー';
        
        return view('users.followers', compact('user', 'followers', 'title'));
    }

    /**
     * フォロー中ユーザーのツイートを表示
     */
    public function followingTweets()
    {
        $followingIds = Auth::user()->follows()->pluck('users.id')->toArray();
        
        // フォロー中のユーザーとログインユーザー自身のツイートを取得
        $tweets = \App\Models\Tweet::with(['user', 'category', 'likes'])
            ->whereIn('user_id', $followingIds)
            ->latest()
            ->paginate(20);
            
        return view('tweets.following', compact('tweets'));
    }
} 