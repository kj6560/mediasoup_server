<?php

$request_url = substr($_SERVER['REQUEST_URI'], 1);
$parsed_url = parse_url($request_url);
$path_array = $parsed_url['path'];
$path_query = $parsed_url['query'];
$path_controller = explode("/",$path_array)[0];
$path_params = explode("&",$path_query);
echo $path_controller;
print_r($path_params);die;
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
