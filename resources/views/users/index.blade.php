<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリ新規作成 - Homero</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- カスタムCSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <header class="mb-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('tweets.index') }}">Homero</a>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tweets.index') }}">ホーム</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('users.index') }}">ユーザー管理</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container py-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4>ログイン</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('users.login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">ユーザー名</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">メールアドレス</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">

                                <label for="name" class="form-label">パスワード</label>
                                <input type="password" name="password" id="pass" class="form-control" value="{{ old('password') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">パスワード（確認）</label>
                                <input type="password" name="password_confirmation" id="password" class="form-control" value="{{ old('password') }}" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">ログイン</button>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">キャンセル</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Homero. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
