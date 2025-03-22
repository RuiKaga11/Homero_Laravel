@props(['tweet', 'showText' => true])

@auth
    @php
        $hasLiked = $tweet->likes->contains('user_id', Auth::id());
    @endphp
    
    <div class="like-button-container" 
         data-tweet-id="{{ $tweet->id }}" 
         data-liked="{{ $hasLiked ? 'true' : 'false' }}"
         data-like-url="{{ route('tweets.like', $tweet->id) }}"
         data-unlike-url="{{ route('tweets.unlike', $tweet->id) }}"
         data-csrf-token="{{ csrf_token() }}">
         
        <button type="button" class="btn btn-link p-0 like-button {{ $hasLiked ? 'liked' : '' }}">
            <i class="{{ $hasLiked ? 'fas' : 'far' }} fa-heart"></i> 
            @if($showText)
                <span class="like-count">{{ $tweet->likes_count }}</span>
            @endif
        </button>
    </div>
@else
    <span class="like-button">
        <i class="far fa-heart"></i> 
        @if($showText)
            <span>{{ $tweet->likes_count }}</span>
            <small>（いいねするにはログインしてください）</small>
        @endif
    </span>
@endauth 