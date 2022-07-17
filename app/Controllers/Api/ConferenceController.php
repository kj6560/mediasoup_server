<?php

namespace App\Controllers\Api;

use App\AppHelpers;
use App\Auth;
use App\Controllers\Api\ApiController;
use App\Controllers\Controller;
use App\Models\Conference;
use App\Models\ConferenceSession;
use App\Models\Organisation;
use App\Models\User;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends ApiController
{


    //add conference action
    public function create_conf(RouteCollection $routes)
    {
        echo "reached here";
    }
}
