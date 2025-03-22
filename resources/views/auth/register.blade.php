@extends('layouts.app')

@section('title', 'アカウント登録 - Homero')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ユーザー登録</div>
                <div class="card-body">
                    <x-form-errors />
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <x-form-input name="userName" label="ユーザーID" :value="old('userName')" required="true" />
                        <x-form-input name="email" label="メールアドレス" type="email" :value="old('email')" required="true" />
                        <x-form-input name="pass" label="パスワード" type="password" required="true" />
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">登録</button>
                            <a href="{{ route('login') }}" class="btn btn-link">すでにアカウントをお持ちの方はこちら</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 