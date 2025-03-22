<?php


// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TweetController;
// use App\Http\Controllers;

use App\Http\Controllers\TweetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

// トップページのルート
Route::get('/', [TweetController::class, 'index'])->name('home');

// 未認証ユーザー向けツイート一覧ページ（別のパスで定義）
// Route::get('/public-tweets', [TweetController::class, 'index'])->name('tweets.index');

// ツイート一覧ページのルート
Route::get('/tweets', [TweetController::class, 'index'])->name('tweets.index');

// 認証ルート
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ユーザー登録
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

// users/*ルートの修正
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// ユーザープロフィール
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// 認証済みユーザーのみアクセス可能なルート
Route::middleware('auth')->group(function () {
    // ツイートフィード（認証済みユーザー向け）
    Route::get('/tweets', [TweetController::class, 'feed'])->name('tweets.feed');
    
    // ツイート管理
    Route::get('/tweets/create', [TweetController::class, 'create'])->name('tweets.create');
    Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');
    
    // ※重要: 無限スクロール用APIを先に定義！
    Route::get('/tweets/load-more', [TweetController::class, 'loadMore'])->name('tweets.load-more');
    
    // その後に動的パラメータを含むルートを定義
    Route::get('/tweets/{id}', [TweetController::class, 'show'])->name('tweets.show');
    Route::get('/tweets/{id}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::put('/tweets/{id}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{id}', [TweetController::class, 'destroy'])->name('tweets.destroy');
    
    // 返信機能のルート
    Route::post('/tweets/{id}/response', [TweetController::class, 'response'])->name('tweets.response');
    
    // プロフィール編集
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    
    // アカウント削除
    Route::delete('/profile/delete', [UserController::class, 'destroy'])->name('profile.destroy');
    
    // いいね機能
    Route::post('/tweets/{id}/like', [LikeController::class, 'store'])->name('tweets.like');
    Route::delete('/tweets/{id}/like', [LikeController::class, 'destroy'])->name('tweets.unlike');
    
    // 無限スクロール用の追加API
    Route::get('/tweets/{id}/responses/load-more', [TweetController::class, 'loadMoreResponses'])->name('tweets.responses.load-more');
    Route::get('/users/{id}/tweets/load-more', [UserController::class, 'loadMoreTweets'])->name('users.tweets.load-more');
    Route::get('/following-tweets/load-more', [FollowController::class, 'loadMoreFollowingTweets'])->name('following.tweets.load-more');
});

// フォロー関連のルート
Route::middleware(['auth'])->group(function () {
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');
    Route::get('/users/{user}/following', [FollowController::class, 'following'])->name('users.following');
    Route::get('/users/{user}/followers', [FollowController::class, 'followers'])->name('users.followers');
    Route::get('/following-tweets', [FollowController::class, 'followingTweets'])->name('tweets.following');
});

// カテゴリ管理用ルート（管理者向け）
Route::resource('categories', CategoryController::class);

// Route::get('/', function () {
//     return view('welcome');
//     return view('startpage.tweet');
// });

// Route::get('/', [TweetController::class, 'index']->name('index'));
// Route::get('/', 'app\Http\Controllers\TweetController@index');

// ユーザー管理用ルート
Route::resource('users', UserController::class)->except(['destroy']);
Route::post('users/login', [UserController::class, 'login'])->name('users.login');

// その他のuserパスはホームにリダイレクト
Route::get('/user', function() {
    return redirect()->route('home');
});
Route::get('/users', function() {
    return redirect()->route('home');
});