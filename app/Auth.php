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
        // $model = new Tokens;
        // $token_data = $model->findToken($token);
        // $org = new Organisation;
        // $org->id = $token_data['org_id'];
        // $org = $org->getByPk();
        // $return = false;
        // if($token == $org['passphrase'])){
        //     $return = $org;
        // }
        // return $return;

        //change the logic here
        $model = new Tokens;
        $model->findToken($token); 
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
