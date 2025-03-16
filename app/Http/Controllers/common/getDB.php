<?php
function getDb(){
    $dsn = 'mysql:dbname=homero; host=127.0.0.1; charset=utf8';
    $usr = 'testusr';
    $passwd = 'hogehoge';
        try{
            $dbh = new PDO($dsn,$usr,$passwd);
            print'接続成功</br>';
        }catch(PDOExceptiion $e){
            die("接続エラー：{$e->getMessage()}");
        }finally{
            // $dbh = null;
        } 
        return $dbh;
}