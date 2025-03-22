@extends('layouts.app')

@section('title', 'フォロー中タイムライン')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fs-4 mb-0"><i class="fas fa-users"></i> フォロー中タイムライン</h1>
    </div>
    
    <div class="tweets-container">
        @if ($tweets->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> フォロー中のユーザーのツイートがありません。ユーザーをフォローして始めましょう！
            </div>
        @else
            @foreach ($tweets as $tweet)
                <x-tweet-card :tweet="$tweet" :showControls="$tweet->user_id === Auth::id()" />
            @endforeach
            
            <div class="mt-3">
                {{ $tweets->links() }}
            </div>
        @endif
    </div>
@endsection 