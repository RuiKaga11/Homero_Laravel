<?php
//ユーザーがさわる
//select,update,insert,deleteが必要

include('C:\xampp\htdocs\Homero_php\php\common\validation.php');
include('C:\xampp\htdocs\Homero_php\php\common\getDB.php');

class Tweet{
    function getByUserId($userId){
        $dbh = getDb();
        $sql = "SELECT * FROM tweet WHERE {$userId};";
        $stmt = $dbh->query($sql);
        $rows = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    function AllgetTweet(){
        $dbh = getDb();
        $sql = "SELECT * FROM tweet;";
        $stmt = $dbh->query($sql);
        $rows = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
    function updateTextCategoryById($id_, $userId,$text, $categoryId){
        validateIsInt($id_);
        $dbh = getDb();
        $sql = "UPDATE tweet SET TEXT = {$text},CATEGORY_ID = {$categoryId} WHERE ID = {$id_} AND USER_ID = {$userId};";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute();
    }
    function addLikedCountById($id_){
        validateIsInt($id_);
        $dbh = getDb();
        $sql = "UPDATE `tweet` SET LIKED_COUNT = LIKED_COUNT + 1 WHERE ID = {$id_};";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute();
    }
    function create($userId, $text, $categoryId){
        $dbh = getDb();
        $sql = "INSERT INTO tweet (USER_ID,TEXT,CATEGORY_ID) VALUES ({$userId},{$text},{$categoryId});";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute();
    }
    function delete($id_, $userId){
        $dbh = getDb();
        $sql = "DELETE FROM tweet WHERE ID = {$id_} AND USER_ID = {$userId};";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute();  
    }
}