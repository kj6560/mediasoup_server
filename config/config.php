<?php
//site name
define('SITE_NAME', 'Video Conferencing Service');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'https://drrksuri.com/');

define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_USER', 'kj6560@gmail.com');
define('SMTP_PASSWORD', ' ');
define('SMTP_PORT', 465);
$host = "54.70.129.232";
$username = "angeltalk";
$password = "webrtc1@";
$database = "angeltalk";
R::setup("mysql:host=$host;dbname=$database", $username, $password);
