<?php
//ini_set('mbstring.internal_encoding' , 'UTF-8');
//header('Content-Type: text/html; charset=UTF-8');

// Composerでインストールしたライブラリを一括読み込み
require_once __DIR__ . '/vendor/autoload.php';

// アクセストークンを使いCurlHTTPClientをインスタンス化
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);

if (!empty($_GET)) {
  //引数でメッセージが渡されていれば、取得して送信
  $message = $_GET['msg'];
  $Call = $_GET['Call'];

  //ユーザIDをJSONファイルから読み込み。
  $jsonUrl = "userinfo.json"; //JSONファイルの場所とファイル名を記述
  if(file_exists($jsonUrl)){
    $json = file_get_contents($jsonUrl);
    //$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $obj = json_decode($json,true);
    //ユーザ情報を１件づつチェック
    foreach ($obj as $key => $val){
      if($Call==1){
        //>>>20180909 呼び出し用スマホに送信
        if($val["delivery"]==1){
          error_log("メッセージ送信先：" . $key);
          error_log("メッセージ送信内容：" . $message);
          // 送信フラグがONなら、メッセージをユーザーID宛にプッシュ
          $response = $bot->pushMessage($key, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message));
          if (!$response->isSucceeded()) {
            error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
          }
        }
      } else {
        //>>>20180909 アラーム用スマホに送信
        if($val["Alarm_delivery"]==1){
          error_log("メッセージ送信先：" . $key);
          error_log("メッセージ送信内容：" . $message);
          // 送信フラグがONなら、メッセージをユーザーID宛にプッシュ
          $response = $bot->pushMessage($key, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message));
          if (!$response->isSucceeded()) {
            error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
          }
        }
      }
    }
  }else {
    //return;
    error_log("データがありません");
  }
}

?>
