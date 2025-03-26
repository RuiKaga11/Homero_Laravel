<header class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tweets.index') }}">Homero</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- 非ログイン時のナビゲーション -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('tweets.index') ? 'active' : '' }}" href="{{ route('tweets.index') }}">ホーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('login') ? 'active' : '' }}" href="{{ route('login') }}">ログイン</a>
                        </li>
                    @else
                        <!-- ログイン時のナビゲーション -->
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('tweets.feed') ? 'active' : '' }}" href="{{ route('tweets.feed') }}">ホーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('users.show') && Auth::id() == request()->route('id') ? 'active' : '' }}" href="{{ route('users.show', Auth::id()) }}">プロフィール</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item {{ Route::is('users.edit') ? 'active' : '' }}" href="{{ route('users.edit', ['user' => Auth::id()]) }}">プロフィール編集</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">ログアウト</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header> 