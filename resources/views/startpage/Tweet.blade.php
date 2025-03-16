<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />

    <title>homero</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    </head>
    <body>

    <h1>Homero</h1>
    
    <div class="tweets-container">
        {{-- @dd($tweet_infos); --}}
        @foreach ($tweet_infos as $tweet)
            <div class="tweet-item">
                <h3>{{ $tweet['user_name'] }}</h3>
                <p>{{ $tweet['content'] }}</p>
                {{-- <small>投稿日時: {{ $tweet->created_at }}</small> --}}
            </div>
        @endforeach
    </div>

</body>
</html>
