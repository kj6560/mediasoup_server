<?php

$request_url = substr($_SERVER['REQUEST_URI'], 1);
$parsed_url = parse_url($request_url);
$path_array = explode("/", $parsed_url['path']);
$path_params = explode("&", $parsed_url['query']);

$path_controller = ucfirst($path_array[0]);
$path_function = !empty($path_array[1]) ? $path_array[1] : "index";

spl_autoload_register(function ($className) {
    $path = "mvc/controllers/";
    $file = $path . $className . '.php';
    if (file_exists($file)) {
        include $file;
    } else {
        throw new Exception("Unable to load $className.");
    }
});
try {
    call_user_func(array($path_controller, $path_function)); 
    //call_user_func_array(array($path_controller, $path_function), $path_params);
} catch (Exception $e) {
    echo $e->getMessage(), "\n";
}
