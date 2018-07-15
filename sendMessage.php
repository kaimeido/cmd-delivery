<?php
//ini_set('mbstring.internal_encoding' , 'UTF-8');
//header('Content-Type: text/html; charset=UTF-8');

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

/*
if (!empty($_GET)) {
  //引数でメッセージが渡されていれば、取得して送信
  $message = $_GET['msg'];
  //$message = mb_convert_encoding($message, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

  //AISpeakerで発言した内容が書かれているサーバ上のファイルを読み込み、json形式に。
  $url = "input.json";
  $json = file_get_contents($url);
  $arr = json_decode($json,true);
  //メッセージ部分を取得
  if ($arr === NULL) {
    return;
  }else{
    //AIスピーカの発言内容をクリア
    $arr["SpeakerMsg"] = $message;

    //JSONファイルへ追加
    $arr = json_encode($arr);
    file_put_contents($url , $arr);

  }
} else {
  //AISpeakerで発言した内容が書かれているサーバ上のファイルを読み込み、json形式に。
  $url = "input.json";
  $json = file_get_contents($url);
  $arr = json_decode($json,true);
  //メッセージ部分を取得
  if ($arr === NULL) {
    return;
  }else{
    //AIスピーカの発言内容を取得
    $message = $arr["SpeakerMsg"];
  }
}
*/

if (!empty($_GET)) {
  //引数でメッセージが渡されていれば、取得して送信
  $message = $_GET['msg'];

  //ユーザIDをJSONファイルから読み込み。
  $jsonUrl = "userinfo.json"; //JSONファイルの場所とファイル名を記述
  if(file_exists($jsonUrl)){
    $json = file_get_contents($jsonUrl);
    //$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $obj = json_decode($json,true);
    //ユーザ情報を１件づつチェック
    foreach ($obj as $key => $val){
      if($val["delivery"]==1){
        error_log("メッセージ送信先：" . $key);
        error_log("メッセージ送信内容：" . $message);
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
}

?>
