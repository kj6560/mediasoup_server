<?php
class Controller
{

    public function loadModel($name)
    {
        $path = 'mvc/model/' . $name . '.php';
        echo $path;
        include $path;
        return new $name();
    }
}
