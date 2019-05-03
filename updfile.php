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
									<ul class="actions stacked">
										<form action="updfile-result.php" method="post" enctype="multipart/form-data">
										<div id="file_input">
											<li><input type="file" id="file" name="file"><label for="file" id="file_label" class="button primary fit">ファイルを選択</label></li>
						        </div>
									  </form>
										<!-- サムネイル表示領域 -->
										<li><canvas id="canvas" width="0" height="0"></canvas></li>
										<!-- <li><canvas id="canvas"></canvas></li> -->
										<!-- アップロード開始ボタン -->
										<button class="button fit" id="upload"><font size="3">画像送信</font></button>
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


	<!-- 以下、javascript -->
	<script type="text/javascript">
	$(function() {
	  var file = null; // 選択されるファイル
	  var blob = null; // 画像(BLOBデータ)
	  const THUMBNAIL_WIDTH = 600; // 画像リサイズ後の横の長さの最大値
	  const THUMBNAIL_HEIGHT = 600; // 画像リサイズ後の縦の長さの最大値

	  // ファイルが選択されたら
	  $('input[type=file]').change(function() {

	    // ファイルを取得
	    file = $(this).prop('files')[0];
	    // 選択されたファイルが画像かどうか判定
	    if (file.type != 'image/jpeg' && file.type != 'image/png') {
	      // 画像でない場合は終了
	      file = null;
	      blob = null;
	      return;
	    }

	    // 画像をリサイズする
	    var image = new Image();
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      image.onload = function() {
	        var width, height;
	        if(image.width > image.height){
	          // 横長の画像は横のサイズを指定値にあわせる
	          var ratio = image.height/image.width;
	          width = THUMBNAIL_WIDTH;
	          height = THUMBNAIL_WIDTH * ratio;
	        } else {
	          // 縦長の画像は縦のサイズを指定値にあわせる
	          var ratio = image.width/image.height;
	          width = THUMBNAIL_HEIGHT * ratio;
	          height = THUMBNAIL_HEIGHT;
	        }
	        // サムネ描画用canvasのサイズを上で算出した値に変更
	        var canvas = $('#canvas')
	                     .attr('width', width)
	                     .attr('height', height);
	        var ctx = canvas[0].getContext('2d');
	        // canvasに既に描画されている画像をクリア
	        ctx.clearRect(0,0,width,height);
	        // canvasにサムネイルを描画
	        ctx.drawImage(image,0,0,image.width,image.height,0,0,width,height);

	        // canvasからbase64画像データを取得
	        var base64 = canvas.get(0).toDataURL('image/jpeg');
	        // base64からBlobデータを作成
	        var barr, bin, i, len;
	        bin = atob(base64.split('base64,')[1]);
	        len = bin.length;
	        barr = new Uint8Array(len);
	        i = 0;
	        while (i < len) {
	          barr[i] = bin.charCodeAt(i);
	          i++;
	        }
	        blob = new Blob([barr], {type: 'image/jpeg'});
	        console.log(blob);
	      }
	      image.src = e.target.result;
	    }
	    reader.readAsDataURL(file);
			$(".filename").html(file.name);

	  });


	  // アップロード開始ボタンがクリックされたら
	  $('#upload').click(function(){

	    // ファイルが指定されていなければ何も起こらない
	    if(!file || !blob) {
	      return;
	    }
	    var name, fd = new FormData();
	    fd.append('file', blob); // ファイルを添付する

	    $.ajax({
	      url: "updfile-result.php", // 送信先 ここでファイルが送信される
	      type: 'POST',
	      dataType: 'json',
	      data: fd,
	      processData: false,
	      contentType: false
	    })

	    .done(function( data, textStatus, jqXHR ) {
	      // 送信成功
				console.log("TEST");
	    })
	    .fail(function( jqXHR, textStatus, errorThrown ) {
	      // 送信
				console.log("hello world!");
				//ページ遷移
				location.href = "updfile-result.php";						//ファイル送信のPHPと同じだが、ここでは結果を表示する
	    });

	  });

	});
	</script>

</html>
