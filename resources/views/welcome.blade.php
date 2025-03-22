@extends('layouts.app')

@section('title', 'Homero - ホーム')

@section('content')
    <div class="text-center py-5">
        <h1 class="display-4 mb-4"><i class="fas fa-feather-alt"></i> Homero</h1>
        <p class="lead mb-4">いつでも、どこでも、思いを共有しよう</p>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Homeroへようこそ！</h5>
                        <p class="card-text">すでにアカウントをお持ちの方はログインしてください。<br>
                        新規ユーザーの方はアカウントを作成してください。</p>
                        
                        <div class="d-grid gap-2">
                            @auth
                                <a href="{{ route('tweets.feed') }}" class="btn btn-primary">
                                    <i class="fas fa-home"></i> ホームタイムライン
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> ログイン
                                </a>
                                <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus"></i> アカウント作成
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
