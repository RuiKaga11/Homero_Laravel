<?php


use Illuminate\Support\Facades\Route;
use app\Http\Controllers\TweetController;
use app\Http\Controllers;



Route::get('/', function () {
    // return view('welcome');
    return view('startpage.tweet');
});

// Route::get('/', [TweetController::class,'index']->name('index'));
// Route::get('/', 'app\Http\Controllers\TweetController@index');