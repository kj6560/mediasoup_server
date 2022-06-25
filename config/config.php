<?php
//site name
define('SITE_NAME', 'Video Conferencing Service');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE','https://drrksuri.com/');
R::setup( 'mysql:host=54.70.129.232;dbname=angeltalk', 'angeltalk', 'webrtc1@' );