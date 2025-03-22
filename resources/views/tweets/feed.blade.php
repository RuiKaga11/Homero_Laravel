@extends('layouts.app')

@section('title', 'ホーム')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-4 mb-0"><i class="fas fa-home"></i> ホームタイムライン</h1>
        <a href="{{ route('tweets.create') }}" class="btn btn-primary d-md-none">
            <i class="fas fa-feather"></i> ツイート
        </a>
    </div>
    
    <div class="tweets-container">
        @foreach ($tweets as $tweet)
            <x-tweet-card :tweet="$tweet" :showControls="$tweet->user_id === $user->id" />
        @endforeach
        
        @if ($tweets->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> ツイートがありません。最初のツイートを投稿しましょう！
            </div>
        @endif
    </div>
@endsection 