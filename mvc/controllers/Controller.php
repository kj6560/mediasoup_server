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
        echo "loading".$name;exit;
    }
}
