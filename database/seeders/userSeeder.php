<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        user::create([
            'name' => 'Test User',
            'password' => 'pass',
            'email' => 'test@example.com',
        ]);
    }
}
