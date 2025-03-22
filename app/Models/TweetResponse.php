<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetResponse extends Model
{
    use HasFactory;
    
    protected $fillable = ['tweet_id', 'response_tweet_id'];
    
    /**
     * 元のツイート
     */
    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id');
    }
    
    /**
     * 返信ツイート
     */
    public function responseTweet()
    {
        return $this->belongsTo(Tweet::class, 'response_tweet_id');
    }
} 