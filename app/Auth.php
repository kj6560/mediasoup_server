<?php

namespace App;

use App\Models\Organisation;
use App\Models\Tokens;
use RedBeanPHP\R;

class Auth
{
    public function guard($type)
    {
        
        $authModel = "App\\Models\\" . ucfirst($type);
        $model = new $authModel;
        $model->id = !empty($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;
        $authData = $model->getByPk();
        if (!empty($_SESSION['login_id']) && !empty($_SESSION['login_id'])) {
            return $authData;
        }
    }
    public function apiGuard($token)
    {
        $model = new Tokens;
        $org = $model->findToken($token); 
        if(empty($org)){
            return false;
        }
        return $org;
    }
    public static function logger($type)
    {
        $authModel = "App\\Models\\" . ucfirst($type);
        $model = new $authModel;
        $model->id = !empty($_SESSION['login_id']) ? $_SESSION['login_id'] : 0;
        $authData = $model->getByPk();
        if (!empty($_SESSION['login_id']) && !empty($_SESSION['login_id'])) {
            return $authData;
        }
    }
}
