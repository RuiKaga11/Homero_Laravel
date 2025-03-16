<?php
# ユーザー定義関数でログイン処理・アカウント登録を分けて担う

$userID = $_POST['userid'];
$password = $_POST['pass'];

include('getDB.php');
include('Join.php');

# フォームから入ってきた値を変数にいれる
#　変数の値を接続先のDBと照合させる
#　内容に応じてログインの成否を行う
#　ここまで完了！！！
# ログインの成否をhtmlに出力する->後回しにする

class login{
    
    function login(){
        global $User;
        $User = $_POST['userid']; 
        $Pass = $_POST['pass'];
        $dbUser = strJoin($User);
        $dbPass = strJoin($Pass);
        // echo $dbUser;
        // echo $dbPass;
        $dbh = getDb();
        // $sql = "SELECT {$dbUser},{$dbPass} FROM account;";
        $sql = "SELECT * FROM account WHERE USERID = {$dbUser} AND PASSWORD = {$dbPass};";
        $stmt = $dbh->query($sql);
        $result = $stmt->fetch();
        // var_dump($stmt);
        // var_dump($result);
        session_start(); 
        if($result){
            if (!isset($_SESSION[$User])) {
                $_SESSION['userId'] = $User;
                echo 'せっしょん';
                var_dump($_SESSION['userId']);
            }else{}
            echo 'ログイン成功';
            header("Location:http://localhost/Homero_php/home.html");
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
