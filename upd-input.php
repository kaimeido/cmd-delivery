<?php

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

  <p>アップロードするファイルを指定してください。</p>
  <form action="upd-output.php" method="post" enctype="multipart/form-data">
  <p><input type="file" name="file"></p>
  <p><input type="submit" value="アップロード"></p>
  </form>

</body>
</html>
