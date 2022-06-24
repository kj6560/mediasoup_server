<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            echo $path;exit;
            require $path;
            $model = new $name();
            return $model;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
