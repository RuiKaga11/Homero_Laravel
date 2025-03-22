@extends('layouts.app')

@section('title', 'アカウント作成')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="fs-4"><i class="fas fa-user-plus"></i> アカウント新規作成</h1>
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary rounded-pill">
            <i class="fas fa-sign-in-alt"></i> ログイン
        </a>
    </div>

    <div class="card tweet-card">
        <div class="card-body">
            <x-form-errors />

            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4 text-center">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/100" alt="プロフィール画像" class="rounded-circle profile-image" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    
                    <div class="mb-2">
                        <label for="profile_image" class="btn btn-sm btn-outline-secondary rounded-pill">
                            <i class="fas fa-camera"></i> プロフィール画像を選択
                        </label>
                        <input id="profile_image" type="file" name="profile_image" class="d-none" accept="image/*" onchange="previewImage(this)">
                    </div>
                </div>

                <x-form-input name="name" label="名前" :value="old('name')" required="true" />
                <x-form-input name="email" label="メールアドレス" type="email" :value="old('email')" required="true" />
                <x-form-input name="password" label="パスワード" type="password" required="true" />
                <x-form-input name="password_confirmation" label="パスワード（確認）" type="password" required="true" />
                <div class="form-text mb-4">8文字以上で入力してください</div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-user-check"></i> アカウント作成
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <x-image-preview-script />
@endsection
