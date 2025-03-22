@extends('layouts.app')

@section('title', '新規ツイート')

@section('content')
    <div class="mb-4">
        <h1 class="fs-4"><i class="fas fa-feather"></i> 新規ツイート</h1>
    </div>
    
    <div class="card tweet-card">
        <div class="card-body">
            <x-tweet-form :categories="$categories" actionRoute="{{ route('tweets.store') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> ツイートする
                </button>
            </x-tweet-form>
        </div>
    </div>
@endsection 