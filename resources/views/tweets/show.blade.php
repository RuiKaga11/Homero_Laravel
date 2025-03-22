@extends('layouts.app')

@section('title', 'ツイート詳細')

@section('content')    
    <x-tweet-card :tweet="$tweet" :showControls="Auth::id() === $tweet->user_id" :detailed="true" />
    
    <div class="mt-4">
        <h4 class="fs-5"><i class="fas fa-reply"></i> 返信</h4>
        
        @auth
            <form action="{{ route('tweets.response', $tweet->id) }}" method="POST" class="mb-4">
                @csrf
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="2" placeholder="返信を入力..." maxlength="255">{{ old('content') }}</textarea>
                    <div class="form-text text-end">
                        <span id="responseCharCount">0</span>/255
                    </div>
                    @error('content')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-feather"></i> 返信する
                    </button>
                </div>
            </form>
        @else
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle"></i> 返信するには<a href="{{ route('login') }}">ログイン</a>してください。
            </div>
        @endauth
        
        <div id="responses-container" class="mt-4">
            @forelse($responses as $response)
                <div class="card mb-3" id="response-{{ $response->id }}">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="me-3">
                                <a href="{{ route('users.show', $response->user->id) }}" class="text-decoration-none">
                                    <x-user-avatar :user="$response->user" size="40" />
                                </a>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <a href="{{ route('users.show', $response->user->id) }}" class="fw-bold text-decoration-none">
                                            {{ $response->user->name }}
                                        </a>
                                        <span class="text-muted small ms-2">{{ $response->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    @if(Auth::id() === $response->user_id)
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <button class="dropdown-item edit-response-btn" data-response-id="{{ $response->id }}" data-response-content="{{ $response->content }}">
                                                        <i class="fas fa-edit me-2"></i> 編集
                                                    </button>
                                                </li>
                                                <li>
                                                    <form action="{{ route('tweets.destroy', $response->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i> 削除
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <div class="response-content-{{ $response->id }}">
                                    <p class="mb-2">{{ $response->content }}</p>
                                </div>
                                
                                <!-- 編集フォーム（初期状態では非表示） -->
                                <div class="response-edit-form-{{ $response->id }}" style="display: none;">
                                    <form action="{{ route('tweets.update', $response->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="category_id" value="{{ $response->category_id }}">
                                        <div class="form-group">
                                            <textarea name="content" class="form-control" rows="2" maxlength="255">{{ $response->content }}</textarea>
                                            <div class="form-text text-end">
                                                <span class="edit-char-count">{{ strlen($response->content) }}</span>/255
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mt-2">
                                            <button type="button" class="btn btn-outline-secondary me-2 cancel-edit-btn" data-response-id="{{ $response->id }}">
                                                キャンセル
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check"></i> 保存
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- ツイートと同じアクションボタン -->
                                <div class="tweet-actions d-flex justify-content-between w-100 mt-2">
                                    <!-- コメントボタン -->
                                    <div class="action-icon">
                                        <a href="{{ route('tweets.show', $response->id) }}" class="btn btn-link p-0 text-secondary">
                                            <i class="far fa-comment"></i>
                                            <span class="small ms-1">{{ $response->response_tweets_count ?? 0 }}</span>
                                        </a>
                                    </div>
                                    
                                    <!-- リツイートボタン -->
                                    <div class="action-icon">
                                        <button class="btn btn-link p-0 text-secondary">
                                            <i class="fas fa-retweet"></i>
                                        </button>
                                    </div>
                                    
                                    <!-- いいねボタン -->
                                    <div class="action-icon">
                                        <x-like-button :tweet="$response" :showText="true" />
                                    </div>
                                    
                                    <!-- シェアボタン -->
                                    <div class="action-icon">
                                        <button class="btn btn-link p-0 text-secondary">
                                            <i class="fas fa-share-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-light text-center">
                    <i class="far fa-comment-dots me-2"></i>返信はまだありません。最初の返信を投稿しましょう！
                </div>
            @endforelse
        </div>
        
        <div id="loading-indicator" class="text-center my-4 d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">読み込み中...</span>
            </div>
            <p class="mt-2">返信を読み込み中...</p>
        </div>
        
        <div id="sentinel" class="pb-4"></div>
    </div>
@endsection

@push('styles')
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
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let nextPage = 2;
    let loading = false;
    
    const responsesContainer = document.getElementById('responses-container');
    const loadingIndicator = document.getElementById('loading-indicator');
    const sentinel = document.getElementById('sentinel');
    
    // 要素がなければ終了（返信がない場合など）
    if (!responsesContainer || !sentinel) return;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !loading && nextPage !== null) {
                loadMoreResponses();
            }
        });
    }, {
        rootMargin: '0px 0px 100px 0px'
    });
    
    observer.observe(sentinel);
    
    function loadMoreResponses() {
        loading = true;
        loadingIndicator.classList.remove('d-none');
        
        const tweetId = '{{ $tweet->id }}';
        
        fetch(`/tweets/${tweetId}/responses/load-more?page=${nextPage}`)
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    responsesContainer.insertAdjacentHTML('beforeend', data.html);
                }
                
                nextPage = data.nextPage;
                
                if (nextPage === null) {
                    observer.disconnect();
                }
                
                loadingIndicator.classList.add('d-none');
                loading = false;
            })
            .catch(error => {
                console.error('返信の読み込みエラー:', error);
                loadingIndicator.innerHTML = '<p class="text-danger my-4">読み込みエラーが発生しました。再読み込みしてください。</p>';
                loading = false;
            });
    }
    
    // 返信の文字数カウント
    const textarea = document.querySelector('textarea[name="content"]');
    const charCount = document.getElementById('responseCharCount');
    
    if (textarea && charCount) {
        textarea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });
        // 初期表示時にも文字数を表示
        charCount.textContent = textarea.value.length;
    }
    
    // 編集ボタン処理
    const editButtons = document.querySelectorAll('.edit-response-btn');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const responseId = this.dataset.responseId;
            
            // コンテンツ表示を隠して編集フォームを表示
            document.querySelector(`.response-content-${responseId}`).style.display = 'none';
            document.querySelector(`.response-edit-form-${responseId}`).style.display = 'block';
            
            // 編集フォームのテキストエリアにフォーカス
            const editTextarea = document.querySelector(`.response-edit-form-${responseId} textarea`);
            editTextarea.focus();
            editTextarea.selectionStart = editTextarea.value.length;
            
            // 編集フォームの文字数カウント
            editTextarea.addEventListener('input', function() {
                const count = document.querySelector(`.response-edit-form-${responseId} .edit-char-count`);
                count.textContent = this.value.length;
            });
        });
    });
    
    // キャンセルボタン処理
    const cancelButtons = document.querySelectorAll('.cancel-edit-btn');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const responseId = this.dataset.responseId;
            
            // 編集フォームを隠してコンテンツ表示を戻す
            document.querySelector(`.response-content-${responseId}`).style.display = 'block';
            document.querySelector(`.response-edit-form-${responseId}`).style.display = 'none';
        });
    });
});
</script>
@endpush 