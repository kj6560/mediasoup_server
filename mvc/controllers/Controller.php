<?php
class Controller
{

    public function loadModel($name)
    {
        $path = 'mvc/model/' . $name . '.php';
        echo $path;
        if (file_exists($path)) {
            include 'mvc/model/' . $name . '.php';
            $modelName = $name . '';
            return new $modelName();
        }else{
            echo "file not found"; 
        }
    }
}
