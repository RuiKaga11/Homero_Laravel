<?php
// include('C:\xampp\htdocs\Homero_php\php\common\getDB.php');
include('C:\xampp\htdocs\Homero_php\php\models\tweet.php');

class ControlTweet{
    function getTweet(){
        $tweet = new Tweet();
        $rows = $tweet->AllgetTweet();
        header("Access-Control-Allow-Origin: *");
        var_dump($rows);
        return json_encode($rows);
    }
}
$tweet = new ControlTweet();
$tweet->getTweet();