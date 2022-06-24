<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            require $path;
            return new $name();
        } catch (Exception $e) {
            return false;
        }
    }
}
