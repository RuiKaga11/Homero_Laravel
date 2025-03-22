@props(['tweet', 'showControls' => false, 'detailed' => false])

<div class="card tweet-card">
    <div class="card-body">
        <div class="d-flex">
            <div class="me-3">
                <a href="{{ route('users.show', $tweet->user->id) }}" class="text-decoration-none">
                    @if($tweet->user->profile_image)
                        <img src="{{ asset('storage/' . $tweet->user->profile_image) }}" 
                            class="rounded-circle user-avatar" 
                            alt="{{ $tweet->user->name }}"
                            style="width: 48px; height: 48px; object-fit: cover;">
                    @else
                        <div class="user-avatar-placeholder rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 48px; height: 48px; background-color: #{{ substr(md5($tweet->user->name), 0, 6) }};">
                            <span class="text-white fw-bold">{{ strtoupper(substr($tweet->user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </a>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <span class="badge bg-light text-primary">{{ $tweet->category->name }}</span>
                </div>
                
                <p class="{{ $detailed ? 'fs-5 my-3' : 'my-2' }}">{{ $tweet->content }}</p>
                
                <div class="d-flex align-items-center text-muted small mb-2">
                    <span>
                        @if($tweet->created_at)
                            <i class="far fa-clock me-1"></i> {{ $tweet->created_at->format('Y/m/d H:i') }}
                        @else
                            <i class="far fa-clock me-1"></i> 日時不明
                        @endif
                    </span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <div class="me-3">
                            <x-like-button :tweet="$tweet" />
                        </div>
                        <span class="text-muted">
                            <i class="far fa-comment"></i>
                        </span>
                    </div>
                    
                    @if($showControls && Auth::id() === $tweet->user_id)
                        <div>
                            <a href="{{ route('tweets.edit', $tweet->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                <i class="far fa-edit"></i> 編集
                            </a>
                            <form action="{{ route('tweets.destroy', $tweet->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">
                                    <i class="far fa-trash-alt"></i> 削除
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> 