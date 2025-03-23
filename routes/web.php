<?php


// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TweetController;
// use App\Http\Controllers;

use App\Http\Controllers\TweetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', [TweetController::class, 'index'])->name('tweets.index');

// Route::get('/', function () {
//     return view('welcome');
//     return view('startpage.tweet');
// });

// Route::get('/', [TweetController::class, 'index']->name('index'));
// Route::get('/', 'app\Http\Controllers\TweetController@index');

// カテゴリ管理用ルート
Route::resource('categories', CategoryController::class);
// ユーザー管理用ルート
Route::resource('users', UserController::class);
Route::post('users/login', [UserController::class, 'login'])->name('users.login');
Route::post('users/create', [UserController::class, 'create'])->name('users.create');
Route::post('users/store', [UserController::class, 'store'])->name('users.store');

// ウェルカムページルート
// Route::post('users/create', [UserController::class, 'create'])->name('users.create');

