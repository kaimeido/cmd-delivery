

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
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
				<!--
					<header id="header" class="alt">
					</header>
				-->
				<br>
				<!-- Main -->
					<div id="main">
						<section id="cta" class="main special">

						<?php
						if (!empty($_FILES['file']['tmp_name'])) {
							if (is_uploaded_file($_FILES['file']['tmp_name'])) {
								if (!file_exists('upload')) {
									mkdir('upload');
								}

								$file='upload/001.jpg';
	 							if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
	 								//echo $file, 'のアップロードに成功しました。';
	 								echo '画像送信に成功しました。';
	 								echo '<div id="sample"><p><img src="', $file, '"></p></div>';
	 							} else {
	 								echo '画像送信に失敗しました。';
	 							}
							}
						}
						?>

						<header class="major">
							<h2>ファイルを送信しました。</h2>
							<p>The file posted successfully.</p>
						</header>
						<div id="sample"><p><img src="upload/001.jpg"></p></div>

						<ul class="actions special">
						  <a href="updfile.php" class="button primary fit"> 戻る </a>
					  </ul>
						<!-- LINE画像送信開始ボタン -->
						<button class="button fit" id="sendLine"><font size="3">LINE画像送信</font></button>

						<!--
						<form action="sendPicture.php?msg=001.jpg" method="post">
						<input type="submit" class="button fit" value="LINE画像送信">
						</form>
						-->
						</section>
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


		<!-- 以下、javascript -->
		<script type="text/javascript">
		$(function() {

		  // アップロード開始ボタンがクリックされたら
		  $('#sendLine').click(function(){
				var dfd = $.Deferred();
		    $.ajax({
		      url: "sendPicture.php?msg=001.jpg", // 送信先 ここでファイルが送信される
		      type: 'POST'
		    })

				.done(function(returnData) {
			    // 返ってくるのに時間が掛かる処理
			    setTimeout(function() {
			      console.log(returnData);
			      dfd.resolve();
						location.href = "updfile.php";	//処理が終了したら戻る
			    }, 1000);
			  });

			  // fail()は省略
			  return dfd.promise();
		  });

		});
		</script>

</html>
