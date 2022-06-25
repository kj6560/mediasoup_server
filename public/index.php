<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


// Autoloader
require_once '../vendor/autoload.php';

// Load Config
require_once '../config/config.php';
require_once '../config/rb-mysql.php';

// Routes
require_once '../routes/web.php';
require_once '../app/Router.php';

