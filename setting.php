<?php
	//postなら処理を実行する
	if($_SERVER['REQUEST_METHOD']=='POST'){
		//header('Location:https://command-delivery.herokuapp.com/setting.php');
		error_log('POST:' . $_REQUEST['command']);
	} else {
		error_log('GET:' . $_REQUEST['command']);
	}

	// Composerでインストールしたライブラリを一括読み込み
	require_once __DIR__ . '/vendor/autoload.php';
	// アクセストークンを使いCurlHTTPClientをインスタンス化
	$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
	// CurlHTTPClientとシークレットを使いLINEBotをインスタンス化
	$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<meta name="robots" content="index">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<head>
<meta charset="UTF-8">
<title>コマンド配信設定ページ</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<table>
	<thead>
		<tr>
			<th>LINEユーザID</th>
			<th>氏名</th>
			<th>送信</th>
			<th>更新</th>
			<th>削除</th>
		</tr>
	</thead>
	<tbody>
		<?php
			//★★★↓↓↓更新、削除処理↓↓↓★★★
			//引数のUserIDを格納
			$userId = $_REQUEST['key'];
			error_log($userId);

		  //ユーザIDをJSONファイルから読み込み。
		  $jsonUrl = "userinfo.json"; //JSONファイルの場所とファイル名を記述
		  if(file_exists($jsonUrl)){
		    $json = file_get_contents($jsonUrl);
		    $obj = json_decode($json,true);

				if ($_REQUEST['command']=='update') {
					error_log('更新処理に入りました。');
					foreach ($obj as $key2 => $val){
						if($key2==$userId){
							error_log('更新対象です。');
							error_log($key2);
							error_log($_REQUEST['userName']);
							//同じUser_IDの場合は、画面で入力されたUserNameを利用
							$arr[$key2]['userName'] = htmlspecialchars($_REQUEST['userName']);
							//送信チェック有無判定
							if(isset($_REQUEST['Delivery'])){
								$arr[$key2]['delivery'] = 1;
							} else {
								$arr[$key2]['delivery'] = 0;
							}
						} else {
							error_log('未更新対象です。');
							error_log($key2);
							error_log($val["userName"]);
							//異なるUserIdの場合は、再作成。
							$arr[$key2]['userName'] = $val["userName"];
							$arr[$key2]['delivery'] = $val["delivery"];
						}
					}
					//JSONファイルへ追加
					$arr = json_encode($arr);
					file_put_contents("userinfo.json" , $arr);

				} elseif ($_REQUEST['command']=='delete') {
					error_log('削除処理に入りました。');
					foreach ($obj as $key2 => $val){
						if($key2!==$userId){
							error_log($key2);
							error_log($userId);
							//異なるUserIdの場合は、再作成。
							$arr[$key2]['userName'] = $val["userName"];
							$arr[$key2]['delivery'] = $val["delivery"];
						}
					}
					//JSONファイルへ追加
					$arr = json_encode($arr);
					file_put_contents("userinfo.json" , $arr);

				} elseif ($_REQUEST['command']=='sendmessage') {
					error_log('メッセージ送信処理に入りました。');
					//テストメッセージを送信
					foreach ($obj as $key2 => $val){
						if($val["delivery"]==1){
							error_log("メッセージ送信：" . $key2);
							error_log($_REQUEST['testMessage']);
							// 送信フラグがONなら、メッセージをユーザーID宛にプッシュ
							$response = $bot->pushMessage($key2, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($_REQUEST['testMessage']));
							if (!$response->isSucceeded()) {
								error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
							}

						}
					}
				} elseif ($_REQUEST['command']=='Speech') {
					error_log('スピーカ処理に入りました。');
					//テストメッセージを送信
					$fullPath = 'python https://lomo-dmyr.ssl-lolipop.jp/Speech.py';
	 				exec($fullPath);
				}
				//リロードされた場合に備えて、クリアしておく
				$_REQUEST['command'] = "";
			} else {
				echo 'エラー。';
			}
			//★★★↑↑↑更新、削除処理↑↑↑★★★

			//★★★↓↓↓画面表示↓↓↓★★★
		  //ユーザIDをJSONファイルから読み込み。
		  $jsonUrl = "userinfo.json"; //JSONファイルの場所とファイル名を記述
		  if(file_exists($jsonUrl)){
		    $json = file_get_contents($jsonUrl);
		    $obj = json_decode($json,true);

				foreach ($obj as $key => $val){
					echo '<tr>';
					echo '<form action="setting.php" method="post">';				//更新用のpost
					echo '<input type="hidden" name="command" value="update">';	//更新用の引数
					echo '<input type="hidden" name="key" value="' , $key , '">';

					echo '  <td>', $key, '</td>';
					echo '  <td><input type="text" name="userName" value="', $val['userName'], '"></td>';
					if ($val['delivery']==1){
						//チェックON
						echo '  <td><input type="checkbox" name="Delivery" checked="checked"></td>';
					} else {
						echo '  <td><input type="checkbox" name="Delivery"></td>';
					}
					echo '  <td><input type="submit" value="更新"></td>';				//更新用のボタン
					echo '</form>';
					echo '<form action="setting.php" method="post">';				//削除用のpost
					echo '<input type="hidden" name="command" value="delete">';	//削除用の引数
					echo '<input type="hidden" name="key" value="' , $key , '">';
					//echo '  <td> <a href="setting_update.php?key=', $key, '">削除</a></td>';
					echo '  <td><input type="submit" value="削除"></td>';				//削除用のボタン
					echo '</form>';
					echo '</tr>';
				}
			}
		?>
	</tbody>
</table>
	<?php
			//テストメッセージ送信用フォーム
			echo '<br>';
			echo '<form action="setting.php" method="post">';				//送信用のpost
			echo '<input type="hidden" name="command" value="sendmessage">';	//送信用の引数
			echo '<p><input type="text" name="testMessage" value="テストメッセージ"></p>';
			echo '<p><input type="submit" value="メッセージ送信"></p>';
			echo '</form>';
			//テストメッセージ送信用フォーム
			//echo '<br>';
			//echo '<form action="setting.php" method="post">';				//送信用のpost
			//echo '<input type="hidden" name="command" value="Speech">';	//送信用の引数
			//echo '<p><input type="text" name="testSpeech" value="テストコマンドです"></p>';
			//echo '<p><input type="submit" value="AIスピーカで発言"></p>';
			//echo '</form>';
			//★★★↑↑↑画面表示↑↑↑★★★
	?>
</body>
</html>
