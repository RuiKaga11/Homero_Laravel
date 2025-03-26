@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-4 mb-0"><i class="fas fa-home"></i> ホームタイムライン</h1>
        <a href="{{ route('tweets.create') }}" class="btn btn-primary d-md-none">
            <i class="fas fa-feather"></i> ツイート
        </a>
    </div>
    
    <div id="tweets-container" class="tweets-container">
        @foreach ($tweets as $tweet)
            <x-tweet-card :tweet="$tweet" :showControls="$tweet->user_id === $user->id" />
        @endforeach
        
        @if ($tweets->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> ツイートがありません。最初のツイートを投稿しましょう！
            </div>
        @endif
    </div>
    
    <div id="loading-indicator" class="text-center my-4 d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">読み込み中...</span>
        </div>
        <p class="mt-2">ツイートを読み込み中...</p>
    </div>
    
    <div id="sentinel" class="pb-4"></div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let nextPage = 2;
    let loading = false;
    
    const tweetsContainer = document.getElementById('tweets-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const sentinel = document.getElementById('sentinel');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !loading && nextPage !== null) {
                loadMoreTweets();
            }
        });
    }, {
        rootMargin: '0px 0px 100px 0px'
    });
    
    if (sentinel) {
        observer.observe(sentinel);
    }
    
    function loadMoreTweets() {
        loading = true;
        loadingIndicator.classList.remove('d-none');
        
        fetch(`/tweets/load-more?page=${nextPage}`)
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    tweetsContainer.insertAdjacentHTML('beforeend', data.html);
                }
                
                nextPage = data.nextPage;
                
                if (nextPage === null) {
                    observer.disconnect();
                    
                    loadingIndicator.classList.add('d-none');
                } else {
                    loadingIndicator.classList.add('d-none');
                }
                
                loading = false;
            })
            .catch(error => {
                console.error('ツイートの読み込みエラー:', error);
                loadingIndicator.innerHTML = '<p class="text-danger my-4">読み込みエラーが発生しました。再読み込みしてください。</p>';
                loading = false;
            });
    }
});
</script>
@endsection 