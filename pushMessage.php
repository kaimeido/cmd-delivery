<?php

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

//AISpeakerで発言した内容が書かれているサーバ上のファイルを読み込み、json形式に。
$url = "http://dmyr.lomo.jp/input.txt";
$json = file_get_contents($url);
//$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr = json_decode($json,true);
//メッセージ部分を取得
if ($arr === NULL) {
  return;
}else{
  //AIスピーカの発言内容を取得
  $message = $arr["result"]["parameters"]["any"];
}

//ユーザIDをJSONファイルから読み込み。
$jsonUrl = "userinfo.json"; //JSONファイルの場所とファイル名を記述
if(file_exists($jsonUrl)){
  $json = file_get_contents($jsonUrl);
  //$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
  $obj = json_decode($json,true);
  //ユーザ情報を１件づつチェック
  foreach ($obj as $key => $val){
    error_log($message);
    if($val["delivery"]==1){
      error_log("メッセージ送信：" . $key);
      // 送信フラグがONなら、メッセージをユーザーID宛にプッシュ
      $response = $bot->pushMessage($key, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message));
      if (!$response->isSucceeded()) {
        error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
      }
    }
  }
}else {
  //return;
  error_log("データがありません");
}

  //AISpekerで発言した内容を、別のJSONファイルにコピーする。
  $url = "input.json";
  $json = file_get_contents($url);
  $arr = json_decode($json,true);
  //メッセージ部分を取得
  if ($message === NULL) {
    return;
  }else{
      //AISpekerで発言した内容を書き込み
      $arr['SpeakerMsg'] = $message;
      //JSONファイルへ追加
      $arr = json_encode($arr);
      file_put_contents("input.json" , $arr);
  }

?>
