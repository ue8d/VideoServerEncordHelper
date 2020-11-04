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
      $outputDir = "E:\share";
      $dir = 'F:\録画データ\encoded/{*.mp4}';

      $no =1;
      exec("cd ".$outputDir, $opt, $return_ver);
      echo $no."<br>";
      foreach(glob($dir,GLOB_BRACE) as $file){
          if(is_file($file)){
              $videoName = substr($file,27,-4);
              $videoPath = $file;
              // $outputVideoPath = $outputDir."/".$videoName;
              $cmd = "ffmpeg -hwaccel cuda -hwaccel_output_format cuda -i '".$videoPath."' -crf 14 -c:a aac -c:v h264_nvenc -segment_format mpegts -segment_time 30 -segment_list '".$videoName.".m3u8' -f segment -f segment '".$videoName."-%03d.ts'";
              exec($cmd, $opt, $return_ver);

              //実行結果の書き込み
              if($return_ver == 0){
                  $return_ver = "正常終了";
              }

              //エコー
              echo "No：".$no." "."実行結果：".$return_ver."<br>";
              // echo "No：".$no." "."実行コマンド：".$cmd."<br>";
              $no++;
          }
      }
      ?>
    </div>

    <footer class="index">
      <p>© All rights reserved by ue8d.</p>
    </footer>
  </body>
</html>