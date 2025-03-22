<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Homero')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- カスタムCSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style>
        body {
            background-color: #f7f9fa;
            color: #14171a;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        
        .sidebar {
            position: sticky;
            top: 20px;
        }
        
        .tweet-card {
            border-radius: 15px;
            border: 1px solid #ebeef0;
            margin-bottom: 12px;
            transition: background-color 0.2s;
        }
        
        .tweet-card:hover {
            background-color: #f8f9fa;
        }
        
        .btn-primary {
            background-color: #1da1f2;
            border-color: #1da1f2;
            border-radius: 30px;
            font-weight: bold;
        }
        
        .btn-primary:hover {
            background-color: #0c85d0;
            border-color: #0c85d0;
        }
        
        .btn-outline-primary {
            border-color: #1da1f2;
            color: #1da1f2;
            border-radius: 30px;
        }
        
        .btn-outline-primary:hover {
            background-color: #e8f5fe;
            color: #1da1f2;
        }
        
        .nav-link {
            color: #14171a;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 30px;
            margin-bottom: 8px;
        }
        
        .nav-link:hover {
            background-color: #e8f5fe;
        }
        
        .nav-link.active {
            color: #1da1f2;
        }
        
        .sidebar-menu .nav-link i {
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        .like-button {
            color: #657786;
            transition: all 0.2s;
        }
        
        .like-button:hover, .like-button.liked {
            color: #e0245e;
        }
        
        .main-content {
            border-left: 1px solid #ebeef0;
            border-right: 1px solid #ebeef0;
        }
        
        .profile-header {
            border-bottom: 1px solid #ebeef0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        
        /* モバイル対応 */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                margin-bottom: 20px;
            }
            
            .main-content {
                border: none;
            }
        }
        
        .user-avatar {
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        }
        
        .user-avatar-placeholder {
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            font-weight: bold;
            transition: all 0.2s ease;
        }
        
        .user-avatar-placeholder:hover {
            transform: scale(1.05);
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        }
        
        /* サイドバーUI改善のスタイル */
        .sidebar-profile {
            transition: all 0.2s ease;
            padding: 10px;
            border-radius: 10px;
        }
        
        .sidebar-profile:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .sidebar-nav .list-group-item {
            transition: background-color 0.2s ease;
            border-radius: 10px;
        }
        
        .sidebar-nav .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .user-avatar, .user-avatar-placeholder {
            border: 2px solid #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
        
        .user-avatar:hover, .user-avatar-placeholder:hover {
            transform: scale(1.05);
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        }
        
        a.text-decoration-none:focus, 
        a.text-decoration-none:active,
        .sidebar-nav .list-group-item a:focus,
        .sidebar-nav .list-group-item a:active {
            outline: none;
            text-decoration: none;
        }

        /* サイドバーのユーザーセクションスタイル */
        .user-section {
            border-radius: 15px;
            padding: 15px;
            transition: all 0.2s ease;
        }

        .user-section .nav-link {
            border-radius: 10px;
            font-size: 0.9rem;
            opacity: 0.85;
            transition: all 0.2s ease;
        }

        .user-section .nav-link:hover {
            opacity: 1;
            background-color: rgba(29, 161, 242, 0.1);
        }

        .user-section .nav-link.active {
            background-color: rgba(29, 161, 242, 0.2);
            color: #1da1f2;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <div class="container py-4">
        <div class="row">
            <!-- サイドバー -->
            <div class="col-md-3 d-none d-md-block">
                <x-sidebar />
            </div>
            
            <!-- メインコンテンツ -->
            <div class="col-md-9 main-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>

    <!-- モバイル用フッターナビゲーション -->
    <div class="d-md-none fixed-bottom bg-white border-top p-2">
        <div class="row text-center">
            <div class="col">
                <a href="{{ route('tweets.feed') }}" class="text-decoration-none {{ Route::is('tweets.feed') ? 'text-primary' : 'text-muted' }}">
                    <i class="fas fa-home fa-lg"></i>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('tweets.following') }}" class="text-decoration-none {{ Route::is('tweets.following') ? 'text-primary' : 'text-muted' }}">
                    <i class="fas fa-users fa-lg"></i>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('tweets.create') }}" class="text-decoration-none {{ Route::is('tweets.create') ? 'text-primary' : 'text-muted' }}">
                    <i class="fas fa-pen-to-square fa-lg"></i>
                </a>
            </div>
            @auth
            <div class="col">
                <a href="{{ route('users.show', Auth::id()) }}" class="text-decoration-none {{ Route::is('users.show') && Auth::id() == request()->route('user') ? 'text-primary' : 'text-muted' }}">
                    <i class="fas fa-user fa-lg"></i>
                </a>
            </div>
            @else
            <div class="col">
                <a href="{{ route('login') }}" class="text-decoration-none {{ Route::is('login') ? 'text-primary' : 'text-muted' }}">
                    <i class="fas fa-sign-in-alt fa-lg"></i>
                </a>
            </div>
            @endauth
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- いいねボタンのJavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // すべてのいいねボタンコンテナを取得
            const likeContainers = document.querySelectorAll('.like-button-container');
            
            likeContainers.forEach(container => {
                const button = container.querySelector('.like-button');
                const icon = container.querySelector('i');
                const countElement = container.querySelector('.like-count');
                
                // ボタンにクリックイベントを追加
                button.addEventListener('click', function() {
                    const tweetId = container.dataset.tweetId;
                    const isLiked = container.dataset.liked === 'true';
                    const url = isLiked ? container.dataset.unlikeUrl : container.dataset.likeUrl;
                    const method = isLiked ? 'DELETE' : 'POST';
                    const csrfToken = container.dataset.csrfToken;
                    
                    // いいねボタンのスタイルを即座に変更（楽観的UI更新）
                    if (isLiked) {
                        button.classList.remove('liked');
                        button.classList.remove('text-danger');
                        button.classList.add('text-secondary');
                        icon.classList.replace('fas', 'far');
                        if (countElement) {
                            countElement.textContent = parseInt(countElement.textContent) - 1;
                        }
                    } else {
                        button.classList.add('liked');
                        button.classList.remove('text-secondary');
                        button.classList.add('text-danger');
                        icon.classList.replace('far', 'fas');
                        if (countElement) {
                            countElement.textContent = parseInt(countElement.textContent) + 1;
                        }
                    }
                    
                    // データ属性を更新
                    container.dataset.liked = isLiked ? 'false' : 'true';
                    
                    // Ajaxリクエストの送信
                    fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            if (countElement) {
                                countElement.textContent = data.likes_count;
                            }
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });
        });
    </script>
    
    @stack('scripts')
    
    @yield('scripts')
</body>
</html> 