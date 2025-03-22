@props(['tweet', 'showText' => false])

@auth
    @php
        $hasLiked = Auth::user()->hasLiked($tweet);
    @endphp
    
    <div class="like-button-container" 
         data-tweet-id="{{ $tweet->id }}" 
         data-liked="{{ $hasLiked ? 'true' : 'false' }}"
         data-like-url="{{ route('tweets.like', $tweet->id) }}"
         data-unlike-url="{{ route('tweets.unlike', $tweet->id) }}"
         data-csrf-token="{{ csrf_token() }}">
         
        <button type="button" class="btn btn-link p-0 like-button {{ $hasLiked ? 'liked text-danger' : 'text-secondary' }}">
            <i class="{{ $hasLiked ? 'fas' : 'far' }} fa-heart"></i> 
            @if($showText)
                <span class="like-count">{{ $tweet->likes->count() }}</span>
            @endif
        </button>
    </div>
@else
    <span class="btn btn-link p-0 text-secondary login-required">
        <i class="far fa-heart"></i> 
        @if($showText)
            <span class="like-count">{{ $tweet->likes->count() }}</span>
        @endif
    </span>
@endauth 