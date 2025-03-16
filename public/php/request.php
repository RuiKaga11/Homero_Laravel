<?php
include('getDB.php');
include('Join.php');

class showing{
    function show(){
        echo 'showメソッド呼び出し</br>';
        echo 'ユーザー名がセッションに登録されているか確認</br>';
        session_start(); 
        $userId = $_SESSION["userId"];
        echo $userId;
        $dbh = getDb();
        // $sql = "SELECT ID,USERID,LIKED FROM tweet;";
        $sql = "SELECT ID,LIKED FROM tweet;";
        $stmt = $dbh->query($sql);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($row);
        $exRow = array_column($row, null);
        echo '</br>';
        // print_r($exRow);
        return $exRow;
    }
}


class liked{
    function arrayFormat($exRow){
        // var_dump($exRow);
        echo '<br/>';
        foreach((array)$exRow as $rows){
            echo '<br/>';
            var_dump($rows);
            $id = $rows['ID'];
            echo '<br/>';
            // $userId = $rows['USERID'];
            $liked = $rows['LIKED'];
            var_dump($id);
            // var_dump($userId);  
            var_dump($liked);
            echo 'for';
            // return $liked;
        }
        echo 'for外';
        $liked += 1;
        $dbh = getDb();
        // $sql = "INSERT INTO tweet (LIKED) VALUES ({$LIKED});";
        $sql = "UPDATE tweet SET LIKED = ({$liked}) WHERE ID = {$id};";
        $stmt = $dbh->prepare($sql);
        $result = $stmt->execute();
        var_dump($stmt);
        var_dump($result);
        // var_dump($rows);
        echo '<br/>';
        if($result){
            echo '更新成功</br>';
            // header("Location:http://localhost/Homero_php/home.html");
            return $liked;
            exit();
        }else{
            echo 'ツイート失敗';
           exit();
        }
    }
}
$show = new showing();
$showed = $show->show();

$liked = new liked();

if(true){
    $likedResult = $liked->arrayFormat($showed);
    echo json_encode($likedResult);
}else{}
// $this->liked($format);

// 渡したいデータ
// $res = 'Hello World！'; // 配列や連想配列でも可

// echoすると渡せる
// echo json_encode($res); // json形式にして渡す