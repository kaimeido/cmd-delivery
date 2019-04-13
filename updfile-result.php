<?php
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
	if (!file_exists('upload')) {
		mkdir('upload');
	}
	//ファイル名を変更する
	//$file='upload/'.basename($_FILES['file']['name']);
	$file='upload/001.jpg';
	if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
		//echo $file, 'のアップロードに成功しました。';
		echo '画像アップロードに成功しました。';
		echo '<p><img src="', $file, '"></p>';
	} else {
		echo 'アップロードに失敗しました。';
	}
} else {
	echo 'ファイルを選択してください。';
}

// ファイル名を取得して、ユニークなファイル名に変更
//$file_name = $_FILES['upfile']['name'];
//$uniq_file_name = date("YmdHis") . "_" . $file_name;

?>

<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>画像送信</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<a href="updfile.php" class="button primary"> 戻る </a>
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<header id="header" class="alt">
					</header>

				<!-- Main -->
					<div id="main">
					</div>

				<!-- Footer -->
					<footer id="footer">
					</footer>
			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>

</html>
