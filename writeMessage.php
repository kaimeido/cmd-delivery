<?php

if (!empty($_GET)) {
  //引数でメッセージが渡されていれば、取得してJSONファイルに書き込み
  $message = $_GET['msg'];

  //AISpeakerで発言した内容が書かれているサーバ上のファイルを読み込み、json形式に。
  $url = "input.json";
  $json = file_get_contents($url);
  $arr = json_decode($json,true);
  //メッセージ部分を取得
  if ($arr === NULL) {
    return;
  }else{
    //AIスピーカの発言内容を更新
    date_default_timezone_set('Asia/Tokyo');
    $arr["TimeStamp"] = date("Y/m/d His");
    $arr["SpeakerMsg"] = $message;

    //JSONファイルへ追加
    $arr = json_encode($arr);
    file_put_contents($url , $arr);
  }
}

?>
