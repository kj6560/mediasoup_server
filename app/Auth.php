<?php 
namespace App;
use RedBeanPHP\R;

    class Auth{
        public function guard($type){
            $authModel = "App\\Models\\".ucfirst($type);
            $model = new $authModel;
            $model->id = 1;
            $authData = $model->getByPk();
            print_r($authData);
        }
    }
