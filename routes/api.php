<?php

use App\Auth;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Main Routes system
$routes = new RouteCollection();
$auth = new Auth;
if ($auth->guard('user')) {
    //$routes->add('submit_registration', new Route(constant('URL_SUBFOLDER') . '/submit_registration', array('controller' => 'PageController', 'method'=>'submit_registration'), array(),['POST']));
}
