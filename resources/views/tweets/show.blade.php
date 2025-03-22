@extends('layouts.app')

@section('title', 'ツイート詳細')

@section('content')    
    <x-tweet-card :tweet="$tweet" :showControls="Auth::id() === $tweet->user_id" :detailed="true" />
    
    <div class="mt-4">
        <h4 class="fs-5"><i class="fas fa-comments"></i> コメント</h4>
        <div class="alert alert-secondary">
            <i class="fas fa-info-circle"></i> コメント機能は現在開発中です。
        </div>
    </div>
@endsection 