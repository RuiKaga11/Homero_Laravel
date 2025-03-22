@extends('layouts.app')

@section('title', $title)

@section('content')    
    <div class="card tweet-card">
        <div class="card-header">
            <h5 class="mb-0">{{ $title }}</h5>
        </div>
        <div class="card-body">
            @if($followers->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> フォロワーはいません。
                </div>
            @else
                <div class="list-group">
                    @foreach($followers as $follower)
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-3">
                                <a href="{{ route('users.show', $follower->id) }}">
                                    <x-user-avatar :user="$follower" size="48" />
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $follower->name }}</h6>
                                <p class="text-muted small mb-0">{{ '@' . strtolower(str_replace(' ', '', $follower->name)) }}</p>
                            </div>
                            <div>
                                <x-follow-button :user="$follower" />
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-3">
                    {{ $followers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection 