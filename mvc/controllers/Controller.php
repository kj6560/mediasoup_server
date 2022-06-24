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
        $path = 'mvc/model/' . $name . '.php';

        if (file_exists($path)) {
            require 'mvc/model/' . $name . '.php';
            $modelName = $name . '';
            $this->model = new $modelName();
        }
    }
}
