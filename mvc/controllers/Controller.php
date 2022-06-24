<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            require $path;
            $model = new $name();
            echo "here";
            return $model;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
