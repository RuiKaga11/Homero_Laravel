<?php


// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TweetController;
// use App\Http\Controllers;

use App\Http\Controllers\TweetController;

Route::get('/', [TweetController::class, 'index'])->name('tweets.index');

// Route::get('/', function () {
//     return view('welcome');
//     return view('startpage.tweet');
// });

// Route::get('/', [TweetController::class, 'index']->name('index'));
// Route::get('/', 'app\Http\Controllers\TweetController@index');