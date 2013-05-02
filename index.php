<?php

require_once('config.php');
require_once('codebird.php');

session_start();

if (empty($_SESSION['me'])) {
	header('Location: ' . SITE_URL . 'login.php');
	exit;
}

function h($s) {
	return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();

$cb->setToken($_SESSION['me']['tw_access_token'], $_SESSION['me']['tw_access_token_secret']);

$tweets = (array) $cb->statuses_homeTimeline();
array_pop($tweets);

?>
<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Home : Twitter connect php 2</title>
</head>
<body>
	<h1>ホーム画面</h1>
	<p><?php echo h($_SESSION['me']['tw_screen_name']); ?>のTwitterアカウントでログインしています。</p>
	<p><a href="logout.php">[ログアウト]</a></p>
	
	<ul>
		<?php foreach ($tweets as $tweet): ?>
		<?php if (!$tweet->user->protected): ?>
		<li>
			<?php echo h($tweet->text); ?>
		</li>
		<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</body>
</html>