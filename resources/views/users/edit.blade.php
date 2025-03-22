@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="fs-4"><i class="fas fa-user-edit"></i> プロフィール編集</h1>
        <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left"></i> プロフィールに戻る
        </a>
    </div>

    <div class="card tweet-card">
        <div class="card-body">
            <x-form-errors />

            <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4 text-center">
                    <div class="mb-3 position-relative">
                        <div class="mx-auto" style="width: 100px; height: 100px;">
                            <x-user-avatar :user="$user" :size="100" :fontSize="40" />
                        </div>
                        
                        <label for="profile_image" class="profile-image-overlay position-absolute top-0 start-50 translate-middle-x" style="width: 100px; height: 100px; cursor: pointer; background: rgba(0, 0, 0, 0.5); border-radius: 50%; display: flex; justify-content: center; align-items: center;">
                            <i class="fas fa-camera text-white" style="font-size: 28px;"></i>
                        </label>
                        
                        <input id="profile_image" type="file" name="profile_image" class="d-none" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewImage(this)">
                    </div>
                </div>

                <x-form-input name="name" label="名前" :value="old('name', $user->name)" required="true" />
                <x-form-input name="email" label="メールアドレス" type="email" :value="old('email', $user->email)" required="true" />

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-check"></i> 更新する
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <x-image-preview-script />
@endsection

@section('styles')
<style>
.profile-image-overlay {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.position-relative:hover .profile-image-overlay {
    opacity: 1;
}
</style>
@endsection