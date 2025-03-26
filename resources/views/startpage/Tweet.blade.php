@extends('layouts.app')

@section('title', 'ホーム - Homero')

@section('content')
    <h1 class="my-4">最新のツイート</h1>
    
    <div class="row">
        @foreach ($tweet_infos as $tweet)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info">{{ $tweet['category'] }}</span>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <a href="{{ route('users.show', $tweet['user_id']) }}" class="text-decoration-none">
                                    @if(isset($tweet['user_profile_image']) && $tweet['user_profile_image'])
                                        <img src="{{ asset('storage/' . $tweet['user_profile_image']) }}" 
                                            class="rounded-circle user-avatar" 
                                            alt="{{ $tweet['user_name'] }}"
                                            style="width: 48px; height: 48px; object-fit: cover;">
                                    @else
                                        <div class="user-avatar-placeholder rounded-circle d-flex justify-content-center align-items-center"
                                            style="width: 48px; height: 48px; background-color: #{{ substr(md5($tweet['user_name']), 0, 6) }};">
                                            <span class="text-white fw-bold">{{ strtoupper(substr($tweet['user_name'], 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </a>
                            </div>
                            <p class="card-text">{{ $tweet['content'] }}</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @auth
                                    @php
                                        $hasLiked = isset($tweet['user_has_liked']) ? $tweet['user_has_liked'] : false;
                                    @endphp
                                    
                                    @if ($hasLiked)
                                        <form action="{{ route('tweets.unlike', $tweet['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0">
                                                <i class="fas fa-heart"></i> {{ $tweet['liked_count'] }}
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('tweets.like', $tweet['id']) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-link text-muted p-0">
                                                <i class="far fa-heart"></i> {{ $tweet['liked_count'] }}
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-muted">
                                        <i class="far fa-heart"></i> {{ $tweet['liked_count'] }}
                                        <small>（いいねするにはログインしてください）</small>
                                    </span>
                                @endauth
                            </div>
                            <small class="text-muted">{{ $tweet['created_at'] }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
