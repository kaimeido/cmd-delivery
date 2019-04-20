

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
					</header>

				<!-- Main -->
					<div id="main">
						<section id="cta" class="main special">

						<?php
						/*if (is_uploaded_file($_FILES['file']['tmp_name'])) {

							if (!file_exists('upload')) {
								mkdir('upload');
							}

							$file='upload/001.jpg';
 							if (move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
 								//echo $file, 'のアップロードに成功しました。';


								//画像サイズの縮小
								list($width, $hight) = getimagesize($file); // 元の画像名を指定してサイズを取得
								$baseImage = imagecreatefromjpeg($file); // 元の画像から新しい画像を作る準備
								$image = imagecreatetruecolor(500, 500); // サイズを指定して新しい画像のキャンバスを作成
								// 画像のコピーと伸縮
								imagecopyresampled($image, $baseImage, 0, 0, 0, 0, 500, 500, $width, $hight);
								imagejpeg($image , $file);


 								echo '画像送信に成功しました。';
 								echo '<div id="sample"><p><img src="', $file, '"></p></div>';
 							} else {
 								echo '画像送信に失敗しました。';
 							}
							*/


							if (is_uploaded_file($_FILES["file"]["tmp_name"])) {
					        $file1 = $_FILES["file"]["tmp_name"]; // 元画像ファイル
					        $file2 = "upload/001.jpg"; // 画像保存先のパス
					        $in = ImageCreateFromJPEG($file1); // 元画像ファイル読み込み
					        $width = ImageSx($in); // 画像の幅を取得
					        $height = ImageSy($in); // 画像の高さを取得
					        $min_width = 600; // 幅の最低サイズ
					        $min_height = 600; // 高さの最低サイズ
					        $image_type = exif_imagetype($file1); // 画像タイプ判定用

									if (!file_exists('upload')) {
										mkdir('upload');
									}

					        if ($image_type == IMAGETYPE_JPEG){ // JPGかどうか判定
					            if($width >= $min_width|$height >= $min_height){
					                if($width == $height) {
					                    $new_width = $min_width;
					                    $new_height = $min_height;
					                } else if($width > $height) {//横長の場合
					                    $new_width = $min_width;
					                    $new_height = $height*($min_width/$width);
					                } else if($width < $height) {//縦長の場合
					                    $new_width = $width*($min_height/$height);
					                    $new_height = $min_height;
					                }
					                //　画像生成
					                $out = ImageCreateTrueColor($new_width , $new_height);
					                ImageCopyResampled($out, $in,0,0,0,0, $new_width, $new_height, $width, $height);
					                ImageJPEG($out, $file2);

													echo '画像送信に成功しました。';
													echo '<div id="sample"><p><img src="', $file2, '"></p></div>';

					            } else {
					                echo "サイズが幅".$min_width."×高さ".$min_height."以上の画像をご用意ください";
					            }
					        } else {
					            echo "JPG画像をご用意ください";
					        }
						} else {
							echo 'ファイルを選択してください。';
						}
						?>

						<ul class="actions special">
						  <a href="updfile.php" class="button primary"> 戻る </a>
					  </ul>
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

</html>
