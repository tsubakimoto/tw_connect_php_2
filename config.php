<?php

/*

create database m_dotinstall_tw_connect_php_2;
grant all on m_dotinstall_tw_connect_php_2.* to matsumura@localhost;
 
use m_dotinstall_tw_connect_php_2;
 
create table users (
	id int not null auto_increment primary key,
	tw_user_id varchar(30) unique,
	tw_screen_name varchar(15),
	tw_access_token varchar(255),
	tw_access_token_secret varchar(255),
	created datetime,
	modified datetime
);
 
*/

define('DNS', 'mysql:host=localhost;dbname=m_dotinstall_tw_connect_php_2');
define('DB_USER', 'matsumura');
define('DB_PASSWORD', 'matsumura');

define('CONSUMER_KEY', '4KUTHPSQaKO45VYzqJUuA');
define('CONSUMER_SECRET', 'yldyWjx4WJpRNqrZAIPbSOJLgvXXLbpQMwYsxbpIXw');

define('SITE_URL', 'http://ma.snm.dip.jp/php/tw_connect_php_2/');

error_reporting(E_ALL & ~E_NOTICE);

session_set_cookie_params(0, '/php/tw_connect_php_2/');
