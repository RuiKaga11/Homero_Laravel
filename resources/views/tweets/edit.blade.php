@extends('layouts.app')

@section('title', 'ツイート編集')

@section('content')
    <div class="mb-4">
        <h1 class="fs-4"><i class="fas fa-edit"></i> ツイート編集</h1>
    </div>
    
    <div class="card tweet-card">
        <div class="card-body">
            <x-tweet-form :tweet="$tweet" :categories="$categories" actionRoute="{{ route('tweets.update', $tweet->id) }}">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tweets.feed') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i> キャンセル
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> 更新する
                    </button>
                </div>
            </x-tweet-form>
        </div>
    </div>
@endsection 