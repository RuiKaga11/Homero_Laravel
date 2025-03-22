<div class="sidebar">
    <!-- ロゴ部分 -->
    <div class="mb-4">
        <a href="{{ route('tweets.feed') }}" class="text-decoration-none">
            <h1 class="h4 text-primary mb-0">
                <i class="fas fa-feather-alt"></i> Homero
            </h1>
        </a>
        <p class="text-muted small">homero</p>
    </div>
    
    <!-- メインナビゲーション -->
    <div class="sidebar-menu mb-4">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('tweets.feed') ? 'active' : '' }}" href="{{ route('tweets.feed') }}">
                    <i class="fas fa-home"></i> ホーム
                </a>
            </li>
            
            <!-- フォロータイムラインへのリンクを追加 -->
            <li class="nav-item">
                <a class="nav-link {{ Route::is('tweets.following') ? 'active' : '' }}" href="{{ route('tweets.following') }}">
                    <i class="fas fa-users"></i> フォロー中
                </a>
            </li>
        </ul>
    </div>
    
    @auth
        <!-- ツイートボタン -->
        <div class="d-grid mb-4">
            <a href="{{ route('tweets.create') }}" class="btn btn-primary btn-lg rounded-pill">
                <i class="fas fa-feather"></i> ツイート
            </a>
        </div>
        
        <!-- 区切り線 -->
        <hr class="my-4">
        
        <!-- プロフィール/設定セクション -->
        <div class="user-section mb-4">
            <h6 class="text-uppercase text-muted small fw-bold mb-3">アカウント</h6>
            
            <!-- プロフィールリンク -->
            <a href="{{ route('users.show', Auth::id()) }}" class="d-flex align-items-center mb-3 text-decoration-none text-dark">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                        class="rounded-circle me-2" 
                        alt="{{ Auth::user()->name }}"
                        style="width: 32px; height: 32px; object-fit: cover;">
                @else
                    <div class="rounded-circle d-flex justify-content-center align-items-center me-2"
                        style="width: 32px; height: 32px; background-color: #{{ substr(md5(Auth::user()->name), 0, 6) }};">
                        <span class="text-white small fw-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                    </div>
                @endif
                <span class="small">{{ Auth::user()->name }}</span>
            </a>
            
            <!-- 設定/ログアウトメニュー -->
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link py-1 {{ Route::is('users.edit') ? 'active' : '' }}" href="{{ route('users.edit', ['user' => Auth::id()]) }}">
                        <i class="fas fa-user-edit"></i> プロフィール編集
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link py-1 border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt text-danger"></i> ログアウト
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    @endauth
</div>
