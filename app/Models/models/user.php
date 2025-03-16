<?php
//ユーザーがさわる
//select,update,insert,deleteが必要
//自分の情報だけしか返さない
//生のphpで作成したもの。laravelのひな形に合わせる。

include('C:\xampp\htdocs\Homero_php\php\common\getDB.php');
include('C:\xampp\htdocs\Homero_php\php\common\Join.php');

class Account{
    function getById($id_){
        $dbh = getDb();
        $sql = "SELECT * FROM user WHERE id = {$id_};";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    function registerUser($userName,$email,$pass){
        $joinUserName = strJoin($userName);
        $joinEmail = strJoin($email);
        $joinPass = strJoin($pass);
        $dbh = getDb();
        $sql = "INSERT INTO user (NAME,PASSWORD,EMAIL) VALUES ({$joinUserName},{$joinPass},{$joinEmail});";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute();
    }
    function loginUser($userName,$pass){
        $joinUserName = strJoin($userName);
        $joinPass = strJoin($pass);
        $dbh = getDb();
        $sql = "SELECT NAME,PASSWORD FROM user WHERE NAME = {$joinUserName} AND PASSWORD = {$joinPass};";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($row);
        return $row;
    }
}