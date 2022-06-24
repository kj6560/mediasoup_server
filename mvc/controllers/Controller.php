<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            require $path;
            $model = new $name();
            return $model;
        } catch (Exception $e) {
            return false;
        }
    }
}
