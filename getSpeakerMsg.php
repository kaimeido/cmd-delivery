<?php

//AISpeakerで発言した内容が書かれているサーバ上のファイルを読み込み、json形式に。
$url = "http://dmyr.lomo.jp/input.txt";
$json = file_get_contents($url);
//$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json,true);
//メッセージ部分を取得
if ($arr === NULL) {
  error_log('取得エラー');
  return;
}else{
  //AIスピーカの発言内容を取得
  $message = $arr["result"]["parameters"]["any"];
  error_log($message);
  return $message;
}

?>
