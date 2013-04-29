<?php

require_once('config.php');
require_once('codebird.php');

session_start();

if (empty($_SESSION['me'])) {
	header('Location: ' . SITE_URL . 'login.php');
	exit;
}

?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Home : Twitter connect php 2</title>
</head>
<body>
	<h1>ホーム画面</h1>
	<p>tsubakimoto_sのTwitterアカウントでログインしています。</p>
	<p><a href="logout.php">[ログアウト]</a></p>
</body>
</html>