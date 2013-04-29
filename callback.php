<?php

require_once('config.php');
require_once('codebird.php');

session_start();

\Codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
$cb = \Codebird\Codebird::getInstance();

if (! isset($_GET['oauth_verifier'])) {
	// gets a request token
	$reply = $cb->oauth_requestToken(array(
		'oauth_callback' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
	));

	// stores it
	$cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
	$_SESSION['oauth_token'] = $reply->oauth_token;
	$_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;

	// gets the authorize screen URL
	$auth_url = $cb->oauth_authorize();
	header('Location: ' . $auth_url);
	die();

} elseif (! isset($_SESSION['oauth_verified'])) {
	// gets the access token
	$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$reply = $cb->oauth_accessToken(array(
		'oauth_verifier' => $_GET['oauth_verifier']
	));
	
	// store the authenticated token, which may be different from the request token (!)
	// $_SESSION['oauth_token'] = $reply->oauth_token;
	// $_SESSION['oauth_token_secret'] = $reply->oauth_token_secret;
	// $cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	$cb->setToken($reply->oauth_token, $reply->oauth_token_secret);
	$_SESSION['oauth_verified'] = true;
	
	$me = $cb->account_verifyCredentials();
	var_dump($me);
	exit;
}

/*
object(stdClass)#3 (40) { ["default_profile"]=> bool(false) ["name"]=> string(17) "Matsumura/Tsubaki" ["geo_enabled"]=> bool(true) ["id_str"]=> string(9) "339443914" ["profile_sidebar_border_color"]=> string(6) "FFFFFF" ["profile_background_image_url_https"]=> string(49) "https://si0.twimg.com/images/themes/theme9/bg.gif" ["entities"]=> object(stdClass)#4 (2) { ["url"]=> object(stdClass)#5 (1) { ["urls"]=> array(1) { [0]=> object(stdClass)#6 (4) { ["url"]=> string(22) "http://t.co/mdpfKlAmtJ" ["indices"]=> array(2) { [0]=> int(0) [1]=> int(22) } ["display_url"]=> string(23) "tsubalog.hatenablog.com" ["expanded_url"]=> string(31) "http://tsubalog.hatenablog.com/" } } } ["description"]=> object(stdClass)#7 (1) { ["urls"]=> array(0) { } } } ["verified"]=> bool(false) ["id"]=> int(339443914) ["status"]=> object(stdClass)#8 (19) { ["coordinates"]=> NULL ["in_reply_to_status_id"]=> NULL ["in_reply_to_user_id_str"]=> NULL ["in_reply_to_screen_name"]=> NULL ["entities"]=> object(stdClass)#9 (3) { ["hashtags"]=> array(1) { [0]=> object(stdClass)#10 (2) { ["indices"]=> array(2) { [0]=> int(36) [1]=> int(47) } ["text"]=> string(10) "dotinstall" } } ["user_mentions"]=> array(0) { } ["urls"]=> array(0) { } } ["favorited"]=> bool(false) ["source"]=> string(3) "web" ["created_at"]=> string(30) "Mon Apr 29 00:59:07 +0000 2013" ["place"]=> NULL ["id"]=> float(3.2867477463931E+17) ["in_reply_to_user_id"]=> NULL ["retweet_count"]=> int(0) ["text"]=> string(117) "リンクをミドルクリックしても、何も挙動が起きなくなったのは、自分だけ？ #dotinstall" ["geo"]=> NULL ["retweeted"]=> bool(false) ["in_reply_to_status_id_str"]=> NULL ["id_str"]=> string(18) "328674774639312897" ["contributors"]=> NULL ["truncated"]=> bool(false) } ["listed_count"]=> int(1) ["profile_background_tile"]=> bool(false) ["profile_image_url"]=> string(62) "http://a0.twimg.com/profile_images/1452603277/slime_normal.png" ["profile_sidebar_fill_color"]=> string(6) "252429" ["follow_request_sent"]=> bool(false) ["statuses_count"]=> int(203) ["created_at"]=> string(30) "Thu Jul 21 03:30:23 +0000 2011" ["lang"]=> string(2) "ja" ["is_translator"]=> bool(false) ["utc_offset"]=> int(32400) ["profile_background_color"]=> string(6) "1A1B1F" ["notifications"]=> bool(false) ["default_profile_image"]=> bool(false) ["protected"]=> bool(false) ["description"]=> string(155) "福岡で医療系のSE兼PGをやってます。仕事ではVBやC#、プライベートではPHP/HTML/CSS/JS。Web系をしたいと思っています。" ["contributors_enabled"]=> bool(false) ["favourites_count"]=> int(27) ["screen_name"]=> string(13) "tsubakimoto_s" ["profile_background_image_url"]=> string(47) "http://a0.twimg.com/images/themes/theme9/bg.gif" ["time_zone"]=> string(5) "Tokyo" ["following"]=> bool(false) ["profile_image_url_https"]=> string(64) "https://si0.twimg.com/profile_images/1452603277/slime_normal.png" ["url"]=> string(22) "http://t.co/mdpfKlAmtJ" ["followers_count"]=> int(28) ["profile_link_color"]=> string(6) "1B7591" ["location"]=> string(14) "Fukuoka, Japan" ["friends_count"]=> int(53) ["profile_use_background_image"]=> bool(true) ["profile_text_color"]=> string(6) "666666" ["httpstatus"]=> int(200) } [feedly mini] 
*/