<?php 

$controller = substr($_SERVER['REQUEST_URI'],1);
$url_params = explode(",",$controller);

spl_autoload_register(function($className) {
    $path = "/mvc/controllers/";
    $file = $path.$className . '.php';
    echo $file;
    if (file_exists($file)) {
       echo "$file included\n";
       include $file;
       try {
        $obj1 = new ucfirst($controller);
        } catch (Exception $e) {
        echo $e->getMessage(), "\n";
        }
    } 
    else {
       throw new Exception("Unable to load $className.");
    }
});

