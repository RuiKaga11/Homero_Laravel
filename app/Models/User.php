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
}
