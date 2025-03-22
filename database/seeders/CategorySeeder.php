<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => '技術', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '日常', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ニュース', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'その他', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
