<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tweet;

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
        $user = Auth::user();
        $followingIds = $user->follows()->pluck('users.id');
        
        $tweets = Tweet::whereIn('user_id', $followingIds)
                    ->withBasicRelations()
                    ->latest()
                    ->paginate(10);
        
        return view('tweets.following', compact('tweets'));
    }

    /**
     * フォロー中ユーザーのツイートを無限スクロールで読み込む
     */
    public function loadMoreFollowingTweets(Request $request)
    {
        $page = $request->input('page', 1);
        $user = Auth::user();
        $followingIds = $user->follows()->pluck('users.id');
        
        $tweets = Tweet::whereIn('user_id', $followingIds)
                    ->withBasicRelations()
                    ->latest()
                    ->paginate(15, ['*'], 'page', $page);
        
        $html = '';
        foreach ($tweets as $tweet) {
            $html .= view('components.tweet-card', [
                'tweet' => $tweet,
                'showControls' => auth()->id() === $tweet->user_id
            ])->render();
        }
        
        return response()->json([
            'html' => $html,
            'nextPage' => $tweets->hasMorePages() ? $page + 1 : null,
        ]);
    }
} 