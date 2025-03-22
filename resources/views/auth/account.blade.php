@extends('layouts.app')

@section('title', 'マイアカウント')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>マイアカウント</h4>
        </div>
        <div class="card-body">
            <p>自分のアカウント情報を管理します</p>
            
            <h5 class="mt-4">アカウント情報</h5>
            <ul class="list-group mt-3">
                <li class="list-group-item">ユーザーID: {{ Auth::user()->id }}</li>
                <li class="list-group-item">名前: {{ Auth::user()->name }}</li>
                <li class="list-group-item">メールアドレス: {{ Auth::user()->email }}</li>
            </ul>
            
            <h5 class="mt-4">アカウント管理</h5>
            <div class="mt-3">
                <a href="{{ route('tweets.index', ['user_id' => Auth::id()]) }}" class="btn btn-primary">自分のツイート一覧</a>
                <a href="{{ route('users.edit', Auth::id()) }}" class="btn btn-secondary">アカウント編集</a>
            </div>
        </div>
    </div>
@endsection 