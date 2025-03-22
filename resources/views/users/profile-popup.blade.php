@extends('layouts.app')

@section('title', $user->name . 'のプロフィール')

@section('content')
    <!-- バックグラウンドコンテンツ -->
    <div class="background-content">
        <div class="profile-header mb-4">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <x-user-avatar :user="$user" size="80" />
                </div>
                <div>
                    <h2 class="fs-4 mb-1">{{ $user->name }}</h2>
                    <p class="text-muted mb-2">{{ '@' . strtolower(str_replace(' ', '', $user->name)) }}</p>
                </div>
            </div>
        </div>
        
        <div class="tweets-container">
            <h3 class="fs-5 mb-3"><i class="fas fa-feather"></i> {{ $user->name }}のツイート</h3>
            
            @foreach ($tweets as $tweet)
                <x-tweet-card :tweet="$tweet" :showControls="false" />
            @endforeach
            
            @if ($tweets->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> ツイートがありません。
                </div>
            @endif
        </div>
    </div>

    <!-- Instagramスタイルポップアップ -->
    <div id="instagram-popup" class="instagram-popup">
        <div class="instagram-popup-content">
            <div class="popup-header">
                <button type="button" class="btn-close" aria-label="Close" onclick="closePopup()"></button>
            </div>
            
            <div class="text-center mb-4">
                <div class="avatar-container mb-3">
                    <x-user-avatar :user="$user" size="100" />
                </div>
                <h3 class="fs-4">{{ $user->name }}</h3>
                <p class="text-muted">{{ '@' . strtolower(str_replace(' ', '', $user->name)) }}</p>
            </div>
            <div class="text-center mb-4 mt-4">
                <p class="text-muted">いいねプラットフォーム</p>
            </div>
            
            <div class="d-grid gap-3 px-4">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Homeroに登録</a>
                <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg">ログイン</a>
            </div>
            
            <div class="mt-4 text-center text-muted small">
                <p>登録またはログインして、{{ $user->name }}さんのツイートをチェックしましょう</p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
/* Instagramスタイルポップアップ */
.instagram-popup {
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
}

.instagram-popup-content {
    background-color: white;
    border-radius: 12px;
    max-width: 400px;
    width: 90%;
    padding: 20px 0;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.popup-header {
    position: relative;
    padding: 0 15px 15px;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 15px;
}

.avatar-container {
    display: inline-block;
    border-radius: 50%;
    overflow: hidden;
    border: 1px solid #eee;
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
function closePopup() {
    // ポップアップを閉じると元の画面にリダイレクト
    window.location.href = "{{ route('home') }}";
}

// Escキーでもポップアップを閉じられるようにする
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePopup();
    }
});
</script>
@endsection 