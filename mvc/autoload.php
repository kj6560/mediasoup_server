<?php

$controller = substr($_SERVER['REQUEST_URI'], 1);
$url_params = explode(",", $controller);
print_r($url_params);die;
spl_autoload_register(function ($className) {
    $path = "/mvc/controllers/";
    $file = $path . $className . '.php';
    echo $file;
    if (file_exists($file)) {
        echo "$file included\n";
        include $file;
    } else {
        throw new Exception("Unable to load $className.");
    }
});
try {
    $obj1 = new $url_params[0];
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
