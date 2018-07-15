<?php

//LINEで送信した内容が書かれているサーバ上のファイルを読み込み、json形式に。
$url = "userMsg.json";
$json = file_get_contents($url);
$arr = json_decode($json,true);
//メッセージ部分を取得
if ($arr === NULL) {
  return;
}else{

  foreach ($arr as $key => $val){
    error_log($key);
    //LINEメッセージ内容をクリアする
    $arr[$key]['TimeStamp'] = "";
    $arr[$key]['msg'] = "";
    //JSONファイルへ追加
    $arr = json_encode($arr);
    file_put_contents("userMsg.json" , $arr);
  }

}

?>
