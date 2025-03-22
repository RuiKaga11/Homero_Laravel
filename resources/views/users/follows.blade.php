@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="card tweet-card">
        <div class="card-header">
            <h5 class="mb-0">{{ $title }}</h5>
        </div>
        <div class="card-body">
            @if($follows->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> フォロー中のユーザーはいません。
                </div>
            @else
                <div class="list-group">
                    @foreach($follows as $follow)
                        <div class="list-group-item d-flex align-items-center">
                            <div class="me-3">
                                <a href="{{ route('users.show', $follow->id) }}" style="outline: none !important; text-decoration: none;">
                                    <x-user-avatar :user="$follow" size="48" />
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ $follow->name }}</h6>
                                <p class="text-muted small mb-0">{{ '@' . strtolower(str_replace(' ', '', $follow->name)) }}</p>
                            </div>
                            <div>
                                <x-follow-button :user="$follow" />
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-3">
                    {{ $follows->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* フォロー画面での特別なスタイル修正 */
    .user-avatar-placeholder, 
    .user-avatar-placeholder * {
        outline: none !important;
        border: none !important;
    }
    
    a:focus, a:active {
        outline: none !important;
    }
</style>
@endsection