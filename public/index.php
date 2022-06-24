<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


// Autoloader
require_once '../vendor/autoload.php';

// Load Config
require_once '../config/config.php';
require_once '../config/rb-mysql.php';
R::setup( 'mysql:host=54.70.129.232;dbname=angeltalk', 'angeltalk', 'webrtc1@' );
// Routes
require_once '../routes/web.php';
require_once '../app/Router.php';

