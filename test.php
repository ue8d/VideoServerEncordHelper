<!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8" />
    <title>encorder | ue8d's Videos</title>
    <link rel="stylesheet" type="text/css" href="./CSS/index.css">
  </head>
  <body style="background-color:white">
    <!-- ヘッダー読み込み -->
    <?php include_once "./header.php" ?>

    <div class="main">
      <p>ビデオエンコード</p>
      <?php
        $setLocation = "Set-Location -Path F:\録画データ\encoded";
        exec($setLocation, $opt, $return_ver);
        $cmd = "del '201907281800000102-ちびまる子ちゃん【真夏のクリスマスパーティー／まる子のアリとキリギリス】[字][解][デ].mp4'";
        exec($cmd, $opt, $return_ver);

        //実行結果の書き込み
        if($return_ver == 0){
            $return_ver = "正常終了";
        }

        //エコー
        echo "実行結果：".$return_ver."<br>";
        echo $cmd."<br>";
      ?>
    </div>

    <footer class="index">
      <p>© All rights reserved by ue8d.</p>
    </footer>
  </body>
</html>