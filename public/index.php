<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


// Autoloader
require_once '../vendor/autoload.php';
session_start();
require_once '../config/rb-mysql.php';
// Load Config
require_once '../config/config.php';
require_once '../config/app_auth.php';


// Routes
require_once '../routes/web.php';
require_once '../app/Router.php';
require_once '../app/AppHelpers.php';
