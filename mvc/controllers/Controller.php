<?php
class Controller
{

    public function loadModel($name)
    {
        try {
            $path = 'mvc/model/' . $name . '.php';
            echo file_exists($path);exit;
            include $path;
            $model = new $name();
            return $model;
        } catch (Exception $e) {
            print_r($e->getMessage());
        }
    }
}
