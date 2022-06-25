<?php 
namespace App;
use RedBeanPHP\R;

    class Auth{
        public function guard($type){
            $authModel = "app/Models/".ucfirst($type);
            $model = new $authModel;

        }
    }
