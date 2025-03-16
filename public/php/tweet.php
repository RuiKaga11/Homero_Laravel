<?php
// (未)
# home.htmlから値を受け取る。
// UserIdはlogin.php(index.html)から受け取り、保持する。
# ユーザー名だけ、homeでも保持し続けたい→
# しかし、home.htmlにはuserid入力がないので、formを通したuseridが渡されない。
# どうすればいいんだろう？
// いつ、これ↓を実装するか？
// cookie使ってみる？使ったことないけど、調べれば何とかなりそう
//　ログイン→ユーザーIDだけ、cookieに保持。tweet.phpからcookieを取得
// 取得後、ツイートボタンクリックでDBにTEXTと同時にUSERIDを登録する
// ->成形→home.htmlにユーザー名＋ツイート本文を表示できるようにする

// 未）いいねボタンの作成
// 完了）いいねボタンだけ、int扱いなので、Join.phpのtagJoin()でifでintのとき～～
// 完了）タグ、もしくはid（HTMLの話）をいいねボタン用に出力して、フロントで見た目の変更などを可能にする
// 完了）フロントでいいねボタンの見た目（色も変わる）作成（適当にパクれ）
// 未）js(Ajax)で非同期通信の実装→DBにクリックした分のいいねを加算させる

// （未）ソート機能は後でつくる→非同期通信？で作ってみよう（ソートボタンで遷移をはさみたくない）

// （完了）カテゴリーの実装
// 実装中
//　カテゴリーを選択できるhtmlを作成
// 指定したカテゴリーがDBに保存される
// ※カテゴリーがユーザーに見えるようにするかしないか？？
// カテゴリーを呼び出せる、表示できる->OK！！！！


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
        $sql = "SELECT USERID,TEXT,CATEGORY,LIKED FROM tweet;";
        $stmt = $dbh->query($sql);
        $row = array();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $exRow = array_column($row, null);

        
        // var_dump($exRow);
        echo '</br>';
        // print_r($exRow);
        // $getId = $this->getId();
        if($row){
            echo 'ツイート取得成功';
            echo '</br>ここに過去のツイート</br>';
        // $getId = $this->getId();

            foreach((array)$exRow as $rows){
                $this->getId();
                // var_dump($getId);
                $keys = array_keys($rows);
                echo '<hr>';
                // $joinedId = htmlIdJoin($getId);
                // var_dump($joinedId);
                // echo $joinedId;
                foreach($rows as $key => $value){
                    // $getId = $this->getId();

                    $joinedValue = tagJoin($value);
                    echo $joinedValue;
                }
                echo '</div>';
                // echo '</br>';
            }
            exit();
        }else{
            echo 'ツイート取得失敗';
            exit();
        }
    }

    function getId(){
        echo 'getID呼び出し';
        $dbh = getDb();
        $sql = "SELECT ID FROM tweet;";
        $stmt = $dbh->query($sql);
        // var_dump($stmt);
        // $row = array();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($row);
        // $keys = array_keys($row);
        // var_dump($keys);

        // $nextRow = next($row);
        // var_dump($nextRow);

        foreach($row as $rows){
            // var_dump($rows);
            // $nextRows = next($rows);
            // var_dump($nextRows);
            // print_r($rows);
            // $id = $nextRows;
            $id = $rows['ID'];
            // var_dump($id);
            $joinedId = htmlIdJoin($id);
            echo $joinedId;
            echo '<br/>';
            // return $id;



            // echo $id;
            // $joinedId = htmlIdJoin($id);
            // echo $joinedId;
            // $joinedId = htmlIdJoin($id);
            // echo $joinedId;
            // echo $rows['ID'];
            // echo '<br/>';
            // next($rows);
            // return $joinedId;
            // continue;
        }
        // if(is_int($id)){
        //     $nextRow = next($row);
        //     var_dump($nextRow);
        // }else{} 

        // echo $joinedId;

    // return $id;
}
}
$show = new showing();
$show->show();