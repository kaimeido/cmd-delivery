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
						<h2>LINE画像送信</h2>
						<p>撮影した写真や画像をLINEに送信します。<br />
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Get Started -->
							<section id="cta" class="main special">
								<header class="major">
									<h2>ファイルを選択して下さい。</h2>
									<p>「ファイルを選択」ボタンを押して、<br />
									送信するファイルを指定して下さい。</p>
								</header>
								<footer class="major">
									<ul class="actions special">
										<form action="updfile-result.php" method="post" enctype="multipart/form-data">
										<div id="file_input">
											<li><input type="file" id="file" name="file"><label for="file" id="file_label">ファイルを選択</label></li>
						        </div>
										<li><input type="submit" class="button" value="画像送信"></li>


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

	var resizeImage = function(base64image, callback) {
    const MIN_SIZE = 1000;
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');
    var image = new Image();
    image.crossOrigin = "Anonymous";
    image.onload = function(event){
      var dstWidth, dstHeight;
      if (this.width > this.height) {
        dstWidth = MIN_SIZE;
        dstHeight = this.height * MIN_SIZE / this.width;
      } else {
        dstHeight = MIN_SIZE;
        dstWidth = this.width * MIN_SIZE / this.height;
      }
      canvas.width = dstWidth;
      canvas.height = dstHeight;
      ctx.drawImage(this, 0, 0, this.width, this.height, 0, 0, dstWidth, dstHeight);
      callback(canvas.toDataURL());
    };
    image.src = base64image;
  };

/*
	$('input[name=photo]').change(function(e) {
		var file = e.target.files[0];
		if (file.type.match(/image.*/ /*)) {
			var canvas = document.createElement("canvas"),
					ctx = canvas.getContext('2d'),
					image = new Image(),
					size = 800;
			canvas.width = canvas.height = 0;
			image.src = URL.createObjectURL(file);
			image.onload = function() {
				var w = size, h = image.height * (size/image.width);
				canvas.width = w;
				canvas.height = h;
				ctx.drawImage(image, 0, 0, w, h);

				var img = document.createElement('img');
				img.src = canvas.toDataURL(file.type);

				var head = 'data:' + file.type + ';base64,';
				var imgFileSize = Math.round((img.src.length - head.length)*3/4);
				$('#contents').append("<div><span>" + "元画像サイズ" + (file.size/1024).toFixed(1) + "kb" + " => " + "変換後サイズ" + (imgFileSize/1024).toFixed(1) + "kb" + "</span></div>")

				$("#contents").append(img);
			}
		}
	});
*/

  </script>

</html>
