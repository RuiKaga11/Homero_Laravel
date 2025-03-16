<?php

include('C:\xampp\htdocs\Homero_php\php\models\user.php');

class Register{
    function register(){
        session_start();
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $register = new Account();
        $register->registerUser($userName,$email,$pass);
        if($register){
            echo '登録成功';
            header("Location:http://localhost/Homero_php/index.html");
            exit();
        }else{
            echo '登録失敗';
            header("Location:http://localhost/Homero_php/register.html");
            exit();
        }
    }
}
$register = new Register();
$register->register();