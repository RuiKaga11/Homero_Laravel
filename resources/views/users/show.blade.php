@extends('layouts.app')

@section('title', $user->name . 'のプロフィール')

@section('content')
    <div class="profile-header">
        <div class="d-flex align-items-center">
            <div class="me-3">
                @if (Auth::id() === $user->id)
                    <form id="profileImageForm" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="profile_image" id="profileImageInput" class="d-none" accept="image/*">
                        <label for="profileImageInput" class="profile-image-container position-relative d-inline-block" style="cursor: pointer;">
                            <x-user-avatar :user="$user" size="80" />
                            <div class="profile-image-overlay position-absolute top-0 start-0 w-100 h-100 rounded-circle d-flex justify-content-center align-items-center">
                                <i class="fas fa-camera text-white"></i>
                            </div>
                        </label>
                    </form>
                @else
                    <x-user-avatar :user="$user" size="80" />
                @endif
            </div>
            <div>
                <h2 class="fs-4 mb-1">{{ $user->name }}</h2>
                <p class="text-muted mb-2">{{ '@' . strtolower(str_replace(' ', '', $user->name)) }}</p>
                <p class="text-muted small mb-2">{{ $user->email }}</p>
                <p class="mb-2"><i class="fas fa-list"></i> <strong>{{ $tweets->count() }}</strong> ツイート</p>
            </div>
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
.profile-image-container {
    transition: all 0.3s ease;
}

.profile-image-overlay {
    background: rgba(0, 0, 0, 0);
    transition: all 0.3s ease;
    opacity: 0;
}

.profile-image-container:hover .profile-image-overlay {
    background: rgba(0, 0, 0, 0.5);
    opacity: 1;
}

.profile-image-container:hover img,
.profile-image-container:hover .user-avatar-placeholder {
    filter: brightness(0.8);
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImageForm = document.getElementById('profileImageForm');

    if (profileImageInput) {
        profileImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                profileImageForm.submit();
            }
        });
    }
});
</script>
@endsection 