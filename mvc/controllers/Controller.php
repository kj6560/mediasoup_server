<?php
class Controller
{

    public function loadModel($name)
    {
        $path = 'mvc/model/' . $name . '.php';

        if (file_exists($path)) {
            require 'mvc/model/' . $name . '.php';
            $modelName = $name . '';
            return new $modelName();
        }else{
            echo "file not found"; 
        }
    }
}
