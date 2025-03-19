<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />

    <title>homero</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body>

    <h1>Homero</h1>

    <header class="mb-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">ログイン</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.create') }}">アカウント作成</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <div class="tweets-container">
        {{-- @dd($tweet_infos); --}}
        @foreach ($tweet_infos as $tweet)
            <div class="tweet-item">
                <h3>{{ $tweet['user_name'] }}</h3>
                <p>{{ $tweet['content'] }}</p>
                <button><img src="public\img\nice_heart.png">{{ $tweet['liked_count'] }}</button>
                <p>{{ $tweet['category'] }}</p>
                <p>投稿日時：{{ $tweet['created_at'] }}</p>
            </div>
        @endforeach
    </div>
    <footer class="mt-5 py-3 bg-light">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Homero. All rights reserved.</p>
        </div>
    </footer>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
