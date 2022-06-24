<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');


// Autoloader
require_once '../vendor/autoload.php';
// Load Config
require_once '../config/config.php';

// Routes
require_once '../routes/web.php';
require_once '../app/Router.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
$paths = array("../app/Models");
$isDevMode = false;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => '54.70.129.232',
    'user'     => 'angeltalk',
    'password' => 'webrtc1@',
    'dbname'   => 'angeltalk',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
print_r($entityManager);


