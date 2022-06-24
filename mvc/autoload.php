<?php 

$controller = str_replace("/","",$_SERVER['REQUEST_URI']);
echo $controller;
$path = "/mvc/controllers/";
spl_autoload_register(function($className) {
    $file = $className . '.php';
    if (file_exists($file)) {
       echo "$file included\n";
       include $file;
    } 
    else {
       throw new Exception("Unable to load $className.");
    }
});
try {
$obj1 = new ucfirst($path.$controller);
} catch (Exception $e) {
echo $e->getMessage(), "\n";
}
