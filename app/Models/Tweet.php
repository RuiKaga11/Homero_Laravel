<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //
    protected $table = 'tweets';
    public $timestamps = true;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'content',
    ];

    // ユーザーとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // いいねとのリレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // いいねしたユーザー
    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'likes', 'tweet_id', 'user_id')->withTimestamps();
    }

    // いいね数を返すメソッド
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
