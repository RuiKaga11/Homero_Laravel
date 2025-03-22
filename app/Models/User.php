<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ツイートとのリレーション
    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    // いいねとのリレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // ユーザーがいいねしたツイート
    public function likedTweets()
    {
        return $this->belongsToMany(Tweet::class, 'likes', 'user_id', 'tweet_id')->withTimestamps();
    }

    // フォロー関連のリレーションシップを追加
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id')
                    ->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id')
                    ->withTimestamps();
    }

    // フォロー状態をチェックするメソッド
    public function isFollowing(User $user)
    {
        return $this->follows()->where('followed_id', $user->id)->exists();
    }

    // フォロワー状態をチェックするメソッド
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }
}
