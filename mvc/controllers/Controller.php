<?php 
class Controller{
    public $model;
    function __construct($class_name){       
        $this->loadModel($class_name);
    }

    public function loadModel($name){
        echo $name;exit;
        $name = ucfirst($name);
         $path = 'mvc/model/' . $name . '.php';

         if(file_exists($path)){
              require 'mvc/model/' . $name . '.php';
              $this->model = new $name();            
         }
    }
}
