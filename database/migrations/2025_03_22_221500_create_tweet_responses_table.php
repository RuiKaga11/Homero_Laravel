<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tweet_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tweet_id')->constrained()->onDelete('cascade');
            $table->foreignId('response_tweet_id')->constrained('tweets')->onDelete('cascade');
            $table->timestamps();
            
            // 一意性制約
            $table->unique(['tweet_id', 'response_tweet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweet_responses');
    }
}; 