@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')

    <div class="card tweet-card">
        <div class="card-body">
            <x-form-errors />

            <form method="POST" action="{{ route('users.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4 text-center">
                    <div class="mb-3 position-relative">
                        <x-user-avatar :user="$user" size="100" class="profile-image" style="filter: brightness(0.7);" />
                        <label for="profile_image" class="position-absolute top-50 start-50 translate-middle" style="cursor: pointer;">
                            <i class="fas fa-camera" style="font-size: 28px; color: white;"></i>
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