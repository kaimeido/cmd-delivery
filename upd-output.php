<?php
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
	if (!file_exists('upload')) {
		mkdir('upload');
	}
	$file='upload/'.basename($_FILES['file']['name']);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
		echo $file, 'のアップロードに成功しました。';
		echo '<p><img src="', $file, '"></p>';
	} else {
		echo 'アップロードに失敗しました。';
	}
} else {
	echo 'ファイルを選択してください。';
}
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



</body>
</html>
