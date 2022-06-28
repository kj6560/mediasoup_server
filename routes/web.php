<?php

use App\Auth;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Main Routes system
$routes = new RouteCollection();
$auth = new Auth;
if($auth->guard('user')){
    $routes->add('conference', new Route(constant('URL_SUBFOLDER') . '/conference/{user_id}/{type}', array('controller' => 'ConferenceController', 'method'=>'conference'), array('user_id' => '[0-9]+','type' => '[0-9]+')));
}
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method'=>'index'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method'=>'login'), array()));
