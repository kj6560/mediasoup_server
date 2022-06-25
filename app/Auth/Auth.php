<?php 

use RedBeanPHP\R;

    class Auth{
        public function guard($type){
            $authModel = "app/Models/".$params_auth['provider'];
            $model = new $authModel;
            
        }
    }
