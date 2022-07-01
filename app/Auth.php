<?php

namespace App;

use RedBeanPHP\R;

class Auth
{
    public function guard($type)
    {
        session_start();
        $authModel = "App\\Models\\" . ucfirst($type);
        $model = new $authModel;
        $model->id = !empty($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;
        $authData = $model->getByPk();
        if (isset($_SESSION['logout']) && !$_SESSION['logout']) {
            return $authData;
        }
    }
    public static function logger($type)
    {
        $authModel = "App\\Models\\" . ucfirst($type);
        $model = new $authModel;
        $model->id = isset($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;
        $authData = $model->getByPk();
        if (isset($_SESSION['logout']) && !$_SESSION['logout']) {
            return $authData;
        }
    }
}
