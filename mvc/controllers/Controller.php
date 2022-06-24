<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            include $path;
            $model = new $name();
            print_r($model);
        } catch (Exception $e) {
            print_r($e);
            return false;
        }
    }
}
