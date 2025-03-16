<?php
// UI（html）から受け取った値を、ここで受け取って、
// modelを呼び出し、ここで成否を受け取り、
// viewに渡す。
// viewで動的に渡した中身を表示する、、、でいいはず

include('C:\xampp\htdocs\Homero_php\php\models\user.php');

class Login{
    function login(){
        session_start(); 
        $userName = $_POST['userName']; 
        $pass = $_POST['pass'];
        $login = new Account();
        $login->loginUser($userName,$pass);
        if($login){
            echo 'ログイン成功';
            header("Location:http://localhost/Homero_php/php/views/tweet.php");
            exit();
        }else{
            echo 'ログイン失敗';
            header("Location:http://localhost/Homero_php/index.html");
            exit();
        }
    }
}
$login = new login();
$login->login();