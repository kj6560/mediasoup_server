<?php

namespace App\Controllers\Api;


use App\Controllers\Api\ApiController;
use App\Models\Organisation;
use Symfony\Component\Routing\RouteCollection;

class UserController extends ApiController
{

    public function generate_token(RouteCollection $routes){
        $data = $this->getData();
        $org = new Organisation;
        $org->id = $data['org_id'];
        $org = $org->getByPk();
        $passphrase = $data['org_passkey'];
        if(password_verify($passphrase,$org['passphrase'])){
            echo "verified";
        }else{
            echo "not verified";
        }
    }
	
}
