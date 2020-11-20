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
                //アウトプット先のディレクトリ
                $outputDir = "E:\share/";
                //動画ファイルをおいているディレクトリ
                $dir = 'F:\録画データ\encoded/{*.mp4}';

                $array = array();
                foreach(glob($dir,GLOB_BRACE) as $file){
                    if(is_file($file)){
                        //自分にあった文字数のカットに書き換える
                        $videoName = substr($file,27,-4);
                        $videoPath = $file;
                        $outputVideoPath = $outputDir.$videoName;
                        //弾きたい文字列がある場合は以下に記載する
                        if (preg_match("/▽/", $videoName, $matches)) {
                            array_push($array,$videoPath,$outputVideoPath);
                        }else {
                            $cmd = "ffmpeg -hwaccel cuda -hwaccel_output_format cuda -i '".$videoPath."' -crf 14 -c:a aac -c:v h264_nvenc -segment_format mpegts -segment_time 30 -segment_list '".$outputVideoPath.".m3u8' -f segment -f segment '".$outputVideoPath."-%03d.ts'";
                            echo $cmd."<br>";
                        }
                    }
                }
                echo "<br>";
                //弾いた動画一覧
                var_dump($array);
            ?>
        </div>

        <footer class="index">
            <p>© All rights reserved by ue8d.</p>
        </footer>
    </body>
</html>