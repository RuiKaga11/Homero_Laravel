@extends('layouts.app')

@section('title', $user->name . 'のプロフィール')

@section('content')
    <div class="profile-header">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <x-user-avatar :user="$user" size="80" />
            </div>
            <div>
                <h2 class="fs-4 mb-1">{{ $user->name }}</h2>
                <p class="text-muted mb-2">{{ '@' . strtolower(str_replace(' ', '', $user->name)) }}</p>
                <p class="text-muted small mb-2">{{ $user->email }}</p>
                
                <div class="d-flex mb-2">
                    <p class="me-3 mb-0">
                        <a href="{{ route('users.following', $user) }}" class="text-decoration-none">
                            <strong>{{ $user->follows->count() }}</strong> フォロー中
                        </a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('users.followers', $user) }}" class="text-decoration-none">
                            <strong>{{ $user->followers->count() }}</strong> フォロワー
                        </a>
                    </p>
                </div>
                
                <p class="mb-2"><i class="fas fa-list"></i> <strong>{{ $tweets->count() }}</strong> ツイート</p>
            </div>
            
            @if(Auth::id() !== $user->id)
                <div class="ms-auto">
                    <x-follow-button :user="$user" />
                </div>
            @endif
        </div>
        
        @if (Auth::id() === $user->id)
            <div class="mt-3">
                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-outline-primary rounded-pill">
                    <i class="fas fa-user-edit"></i> プロフィール編集
                </a>
                <button type="button" class="btn btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="fas fa-user-times"></i> アカウント削除
                </button>
            </div>
        @endif
    </div>
    
    <div class="tweets-container">
        <h3 class="fs-5 mb-3"><i class="fas fa-feather"></i> {{ $user->name }}のツイート</h3>
        
        @foreach ($tweets as $tweet)
            <x-tweet-card :tweet="$tweet" :showControls="Auth::id() === $user->id" />
        @endforeach
        
        @if ($tweets->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> ツイートがありません。
            </div>
        @endif
    </div>
    
    <!-- アカウント削除確認モーダル -->
    @if (Auth::id() === $user->id)
        <x-delete-account-modal />
    @endif
@endsection

@section('styles')
<style>
</style>
@endsection

@section('scripts')
<script>
</script>
@endsection