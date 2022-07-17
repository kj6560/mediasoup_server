<?php

use App\Auth;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Main Routes system
$routes = new RouteCollection();
// $auth = new Auth;
// if ($auth->guard('api')) {
//     $routes->add('create_conf', new Route(constant('URL_SUBFOLDER') . '/v1/create_conf', array('controller' => 'Api/ConferenceController', 'method'=>'create_conf'), array(),['POST']));
// }
$routes->add('create_conf', new Route(constant('URL_SUBFOLDER') . '/v1/create_conf', array('controller' => 'Api\ConferenceController', 'method'=>'create_conf'), array(),['POST']));