<?php

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

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/logo.png" alt="" /></span>
						<h1>LINE送信</h1>
						<p>撮影した画像をLINEに送信します<br />
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Get Started -->
							<section id="cta" class="main special">
								<header class="major">
									<h2>ファイルを選択してください。</h2>
									<p>「ファイルを選択」ボタンを押して<br />
									アップロードするファイルを指定してください。</p>
								</header>
								<footer class="major">
									<ul class="actions special">
										<form action="updfile-result.php" method="post" enctype="multipart/form-data">
										<li><div id="file_input">
						          <input type="file" id="file" name="file"><label for="file" id="file_label">ファイルを選択</label>
						        </div></li>
										<li><input type="submit" class="button" value="アップロード"></li>
									</form>
									</ul>
								</footer>
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

	<script type='text/javascript' src='//code.jquery.com/jquery-2.2.4.min.js'></script><script>
  $(function(){
    $("#file").on('change',function(){
      var file = $(this).prop('files')[0];
      if(!($(".filename").length)){
        $("#file_input").append('<span class="filename"></span>');
      }
      $("#file_label").addClass('changed');
      $(".filename").html(file.name);
    });
  });
  </script>

</html>
