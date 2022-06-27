<?php 
namespace App;
use RedBeanPHP\R;

    class Auth{
        public function guard($type){
            session_start();
            $authModel = "App\\Models\\".ucfirst($type);
            $model = new $authModel;
            $model->id = 1;//$_SESSION['login_id'];
            $authData = $model->getByPk();
            if($authData){
                return $authData;
            }else{
                return false;
            }
        }
    }
