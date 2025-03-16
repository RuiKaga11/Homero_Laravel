<?php
//selectのみ

include('php\common\getDB.php');
class Category{
    function getAll(){
        // すべてをSELECT
        $dbh = getDb();
        $sql = "SELECT * FROM tweet;";
        $stmt = $dbh->query($sql);
        $rows = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
} 