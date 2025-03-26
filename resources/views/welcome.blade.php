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


    <div class="login-container">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-lg">Homeroに登録</a>
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark btn-lg">ログイン</a>
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
