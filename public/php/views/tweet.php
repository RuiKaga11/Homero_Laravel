// 使わない
<!DOCTYPE html>
<html>
  <link href="main.css" rel="stylesheet" type="text/css" media="all">
  <head>

    <title>homero_home</title>

    <meta charset="utf-8" />
  </head>
  <body>

    <h1>Homero_ホーム</h1>
    <p>ずらーっとDBを使ってツイートが表示される。表示されることを第一目標に</p>

    <button><a href="account.html">アカウント設定</a></button>

    <form action="php/insertTweet.php" method="post">
        <div>
            <label for="name">ツイートする</label>
            <input type="text" id="tweet" name="tweet">
            <select name="category" size="1">
              <option>選択肢のサンプル1</option>
              <option>選択肢のサンプル2</option>
            </select>
        </div>
        <input type="submit" value="ツイート">
    </form>
    <div id = "tweet">
    </div>
    <form action="index.html" method="post">
        <input type="submit" value="ログアウト">
    </form>
<?php

include('C:\xampp\htdocs\Homero_php\php\controler\tweet.php');
include('C:\xampp\htdocs\Homero_php\php\common\Join.php');

echo 'views/tweet.php呼び出し';
$tweet = new ControlTweet();
$rows = $tweet->getTweet();

$newArray = [];
// var_dump($rows);
foreach($rows as $value){
    $newArray[] = [$value['USER_ID'], $value["TEXT"], $value['LIKED_COUNT'],$value['CATEGORY_ID']];
}
// var_dump($newArray);
echo '<br/>';
echo '<br/>';


foreach($newArray as $value){
    // var_dump($value) ;  
    if(is_array($value)){
        // echo '$valueは配列型';
    }
    echo ',';
    echo '<br/>';
    foreach($value as $values){
        // var_dump($values) ;
        $joined = testTagJoin($values);
        echo $joined;
    }
}
?>

  </body>
</html>

