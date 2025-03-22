<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //
    protected $table = 'tweets';
    public $timestamps = false;
    use HasFactory;

    // ユーザーとのリレーションを定義
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
