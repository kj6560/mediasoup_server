<?php

namespace App\Controllers\Api;


use App\Controllers\Api\ApiController;
use Symfony\Component\Routing\RouteCollection;

class UserController extends ApiController
{

    public function generate_token(RouteCollection $routes){
        $data = $this->getData();
        if(!empty($data)){
            print_r($data);
        }
    }
	
}
