<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />

    <title>homero</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

  </head>
  <body>

    <h1>Homero</h1>
    @dd($validated);

    <form action="php\controler\login.php" method="post">
        <div>
            <label for="name">ユーザID</label>
            <input type="text" id="name" name="userName">
        </div>
        <div>
            <label for="pass">パスワード</label>
            <input type="text" id="pass" name="pass">
        </div>
        <input type="submit" value="ログイン">
    </form>
    <button><a href="registar.html">アカウント登録</a></button>
  </body>
</html>
