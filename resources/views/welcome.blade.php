@extends('layouts.app')

@section('title', 'ようこそ')

@section('content')
    <!-- バックグラウンドコンテンツ -->
    <div class="background-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fs-4 mb-0"><i class="fas fa-home"></i> ホームタイムライン</h1>
            <a href="{{ route('tweets.create') }}" class="btn btn-primary d-md-none">
                <i class="fas fa-feather"></i> ツイート
            </a>
        </div>
        
        <div class="tweets-container">
            @foreach ($tweets as $tweet)
                <x-tweet-card :tweet="$tweet" :showControls="false" />
            @endforeach
            
            @if ($tweets->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> ツイートがありません。最初のツイートを投稿しましょう！
                </div>
            @endif
        </div>
    </div>

    <!-- グレーオーバーレイ -->
    <div id="login-overlay" class="login-overlay">
        <div class="instagram-popup-content">
            <div class="text-center mb-4 mt-4">
                <div class="avatar-container mb-3">
                    <i class="fas fa-feather-alt text-primary" style="font-size: 3.8rem;"></i>
                </div>
                <h3 class="fs-4">Homero</h3>
                <p class="text-muted">いいねプラットフォーム</p>
            </div>
            
            <div class="d-grid gap-3 px-4 mb-4">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Homeroに登録</a>
                <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg">ログイン</a>
            </div>

            <div class="mt-4 text-center text-muted small">
                <p>登録またはログインして、ツイートをチェックしましょう</p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
/* グレーオーバーレイ */
.login-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    pointer-events: auto; /* クリックイベントを受け取る */
}

.instagram-popup-content {
    background-color: white;
    border-radius: 12px;
    max-width: 400px;
    width: 90%;
    padding: 20px 0;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* アバターコンテナの調整 */
.avatar-container {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f8f9fa;
    border-radius: 50%;
    width: 110px;
    height: 110px;
    margin: 0 auto;
    overflow: hidden;
    border: 1px solid #eee;
    /* 上部パディングを削除 */
    padding: 0;
}

/* アイコンの位置調整 */
.avatar-container .fa-feather {
    font-size: 3.5rem;
    /* 位置調整を元に戻す */
    position: static;
}

/* ボタンスタイル */
.btn-primary {
    background-color: #0095F6;
    border-color: #0095F6;
}

.btn-primary:hover {
    background-color: #0085e2;
    border-color: #0085e2;
}

.btn-outline-dark {
    border-color: #dbdbdb;
    color: #262626;
}

.btn-outline-dark:hover {
    background-color: #fafafa;
    color: #262626;
    border-color: #dbdbdb;
}

.btn-lg {
    font-weight: 600;
    padding: 8px 0;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 全てのリンクをブロック（バブリングフェーズでキャプチャ）
    document.body.addEventListener('click', function(e) {
        // オーバーレイ内のリンク以外をキャンセル
        if (!e.target.closest('.instagram-popup-content') || 
            (e.target.closest('.instagram-popup-content') && 
             !e.target.closest('a[href*="login"]') && 
             !e.target.closest('a[href*="register"]'))) {
            e.preventDefault();
            e.stopPropagation();
        }
    }, true);
    
    // ナビゲーションバーの不要なリンクを非表示にする
    hideLoginElements();
});

// モバイルメニューが開かれた時にも実行
document.addEventListener('click', function(e) {
    if (e.target.matches('.navbar-toggler') || e.target.closest('.navbar-toggler')) {
        setTimeout(hideLoginElements, 100);
    }
});

function hideLoginElements() {
    // ナビゲーションバーのログイン・アカウント作成リンクを非表示
    var loginLinks = document.querySelectorAll('.navbar-nav .nav-link[href*="login"], .navbar-nav .nav-link[href*="users/create"], .navbar-nav .nav-link[href*="register"]');
    loginLinks.forEach(function(link) {
        link.style.display = 'none';
    });
}
</script>
@endsection
