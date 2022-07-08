<?php

namespace App\Controllers;

use Symfony\Component\Routing\RouteCollection;

class PageController extends Controller
{

    public function add_client(RouteCollection $routes)
    {
        $this->loadView('dashboard_layout', 'dashboard/dashboard_add_client', array());
    }
}
