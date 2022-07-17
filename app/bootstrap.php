<?php 

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');


// Autoloader
require_once '../vendor/autoload.php';
session_start();
require_once '../config/rb-mysql.php';
// Load Config
require_once '../config/config.php';


// Routes
require_once '../routes/web.php';
require_once '../routes/api.php';
require_once '../app/Router.php';
require_once '../app/AppHelpers.php';
