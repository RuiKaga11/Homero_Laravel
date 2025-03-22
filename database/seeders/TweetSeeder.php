<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tweet;
use App\Models\User;
use App\Models\Category;

class TweetSeeder extends Seeder
{
    public function run(): void
    {
        // ユーザーとカテゴリが存在することを確認
        $user = User::first();
        $categories = Category::all();
        
        if($user && $categories->count() > 0) {
            // サンプルツイートの作成
            Tweet::create([
                'user_id' => $user->id,
                'category_id' => $categories->first()->id,
                'content' => 'これは最初のツイートです',
                'liked_count' => 5,
            ]);
            
            Tweet::create([
                'user_id' => $user->id,
                'category_id' => $categories->skip(1)->first()->id,
                'content' => 'Laravelでアプリケーションを作成中です',
                'liked_count' => 10,
            ]);
        }
    }
} 