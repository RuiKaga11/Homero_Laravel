<?php

include('C:\xampp\htdocs\Homero_php\php\models\tweet.php');

class ControlTweet{
    function getTweet(){
        $tweet = new Tweet();
        $rows = $tweet->AllgetTweet();
        return $rows;
    }
}
