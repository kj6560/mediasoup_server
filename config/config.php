<?php
//site name
define('SITE_NAME', 'Video Conferencing Service');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'https://drrksuri.com/');

define('SMTP_HOST', 'talktoangel.com');
define('SMTP_USER', 'info2018@talktoangel.com');
define('SMTP_PASSWORD', 'info!@#$%^&*()');
define('SMTP_PORT', 465);
$host = "54.70.129.232";
$username = "angeltalk";
$password = "webrtc1@";
$database = "angeltalk";

$host1 = "talktoangel.com";
$username1 = "radeshsuri";
$password1 = "vUN%.VUu%GRE";
$database1 = "ttacorporate";

R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::addDatabase('DB1', "mysql:host=$host;dbname=$database", $username, $password, TRUE);
R::freeze(TRUE);
