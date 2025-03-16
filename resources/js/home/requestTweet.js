var request = new XMLHttpRequest();
request.open('GET', 'http://localhost/Homero_php/php/controler/createTweet.php', true);
responseTweet = request.responseType = 'json';
request.addEventListener('load', function (response) {
    // JSONデータを受信した後の処理
    JSON.stringify(responseTweet, null);
  });
request.send();