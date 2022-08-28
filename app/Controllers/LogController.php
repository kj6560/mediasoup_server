<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class LogController extends Controller
{
    public function accessLogs(RouteCollection $routes)
    {
        echo "hello";
    }
}
