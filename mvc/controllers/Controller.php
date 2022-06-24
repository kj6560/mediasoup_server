<?php
class Controller
{
    public $model;
    function __construct($class_name)
    {
        $this->loadModel($class_name);
    }

    public function loadModel($name)
    {
        spl_autoload_register(function ($className) {
            $path = '../mvc/model/' . $className . '.php';
            $file = $path . $className . '.php';
            if (file_exists($file)) {
                include $file;
            } else {
                throw new Exception("Unable to load $className.");
            }
        });
        try {
            $this->model = new $name;
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }
}
