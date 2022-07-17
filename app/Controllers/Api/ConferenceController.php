<?php

namespace App\Controllers\Api;


use App\Controllers\Api\ApiController;

use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends ApiController
{


    //add conference action
    public function create_conf(RouteCollection $routes)
    {
        echo "reached here";
    }
}
