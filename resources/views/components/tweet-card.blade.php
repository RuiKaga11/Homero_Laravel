@props(['tweet', 'showControls' => false, 'detailed' => false])

<div class="card mb-3 tweet-card">
    <div class="card-body">
        <!-- 返信ツイートの場合、元ツイートへの参照を表示 -->
        @if($tweet->respondedToTweets()->exists())
            <div class="response-reference mb-2">
                <small class="text-muted">
                    <i class="fas fa-reply me-1"></i>
                    @php
                        $originalTweet = $tweet->respondedToTweets()->first();
                    @endphp
                    @if($originalTweet)
                        <a href="{{ route('tweets.show', $originalTweet->id) }}" class="text-decoration-none">
                            {{ $originalTweet->user->name }}さんのツイートへの返信
                        </a>
                    @else
                        <span class="text-muted">返信元のツイートは削除されました</span>
                    @endif
                </small>
            </div>
        @endif

        <div class="d-flex">
            <div class="me-3">
                <a href="{{ route('users.show', $tweet->user_id) }}" class="text-decoration-none">
                    <x-user-avatar :user="$tweet->user" size="48" />
                </a>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-0">
                            <a href="{{ route('users.show', $tweet->user_id) }}" class="text-decoration-none">
                                {{ $tweet->user->name }}
                            </a>
                        </h5>
                        <p class="text-muted small">{{ $tweet->created_at->diffForHumans() }}</p>
                    </div>
                    
                    @if($showControls && Auth::id() === $tweet->user_id)
                        <div class="dropdown">
                            <button class="btn btn-sm btn-link text-muted p-0" type="button" id="tweet-options-{{ $tweet->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="tweet-options-{{ $tweet->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('tweets.edit', $tweet->id) }}">
                                        <i class="fas fa-edit me-2"></i> ツイートを編集
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('tweets.destroy', $tweet->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash-alt me-2"></i> ツイートを削除
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                
                <p class="card-text mb-2">{{ $tweet->content }}</p>
                
                @if(isset($tweet->category))
                    <div class="mb-2">
                        <span class="badge bg-info">{{ $tweet->category->name }}</span>
                    </div>
                @endif
                
                <div class="d-flex justify-content-between align-items-center">
                    <div class="tweet-actions d-flex justify-content-between w-100 mt-2">
                        <!-- コメントボタン -->
                        <div class="action-icon">
                            @auth
                                <a href="{{ route('tweets.show', $tweet->id) }}" class="btn btn-link p-0 text-secondary">
                                    <i class="far fa-comment"></i>
                                    <span class="small ms-1">{{ $tweet->response_tweets_count ?? 0 }}</span>
                                </a>
                            @else
                                <span class="btn btn-link p-0 text-secondary login-required">
                                    <i class="far fa-comment"></i>
                                    <span class="small ms-1">{{ $tweet->response_tweets_count ?? 0 }}</span>
                                </span>
                            @endauth
                        </div>
                        
                        <!-- リツイートボタン -->
                        <div class="action-icon">
                            @auth
                                <button class="btn btn-link p-0 text-secondary">
                                    <i class="fas fa-retweet"></i>
                                </button>
                            @else
                                <span class="btn btn-link p-0 text-secondary login-required">
                                    <i class="fas fa-retweet"></i>
                                </span>
                            @endauth
                        </div>
                        
                        <!-- いいねボタン -->
                        <div class="action-icon">
                            <x-like-button :tweet="$tweet" :showText="true" />
                        </div>
                        
                        <!-- シェアボタン -->
                        <div class="action-icon">
                            @auth
                                <button class="btn btn-link p-0 text-secondary">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            @else
                                <span class="btn btn-link p-0 text-secondary login-required">
                                    <i class="fas fa-share-alt"></i>
                                </span>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tweet-actions {
    max-width: 280px;
}
.action-icon {
    text-align: center;
    width: 40px;
    padding: 0.5rem 0;
}
.btn-link {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
    text-decoration: none;
}
.like-button, .like-button:hover, .like-button:focus {
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}
.like-count {
    display: inline-block;
    min-width: 16px;
}
</style> 