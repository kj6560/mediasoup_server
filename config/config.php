<?php
//site name
define('SITE_NAME', 'TalkToAngel');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'https://drrksuri.com/');


$host = "54.70.129.232";
$username = "angeltalk";
$password = "webrtc1@";
$database = "angeltalk";
 
$host1 = "talktoangel.com";
$username1 = "radeshsuri";
$password1 = "vUN%.VUu%GRE";
$database1 = "ttacorporate";

R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::addDatabase('DB1', "mysql:host=$host1;dbname=$database1", $username1, $password1, TRUE);
R::freeze(TRUE);
