
fetch('php/request.php') // サーバ側のphpファイル
    .then(response => response.json()) 
    // 返ってきたレスポンスをjsonで受け取って次のthenへ渡す
    
    .then(res => {
        console.log(res) // やりたい処理
    })
     .catch(error => {
        console.log(error) // エラー表示
    });