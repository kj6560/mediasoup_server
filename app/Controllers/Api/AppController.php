<?php

namespace App\Controllers\Api;

use App\Auth;
use App\Controllers\Api\ApiController;
use App\Controllers\EmailController;
use App\Models\Conference;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class AppController extends ApiController
{
    public function app_login(){
        echo "hello";
    }
}