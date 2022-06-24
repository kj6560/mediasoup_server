<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            include $path;
            $model = new $name;
            echo "there";
            return $model;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
