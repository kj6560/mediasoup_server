<?php

use App\Auth;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Main Routes system
$routes = new RouteCollection();
$auth = new Auth;
if($auth->guard('user')){
    $routes->add('conference', new Route(constant('URL_SUBFOLDER') . '/conference/{user_id}/{type}', array('controller' => 'ConferenceController', 'method'=>'conference'), array('user_id' => '[0-9]+','type' => '[0-9]+')));
    $routes->add('dashboard', new Route(constant('URL_SUBFOLDER') . '/dashboard', array('controller' => 'PageController', 'method'=>'dashboard'), array()));
    $routes->add('users', new Route(constant('URL_SUBFOLDER') . '/users', array('controller' => 'PageController', 'method'=>'users'), array()));
    $routes->add('conferences', new Route(constant('URL_SUBFOLDER') . '/conferences', array('controller' => 'ConferenceController', 'method'=>'conferences'), array()));
    $routes->add('conference_detail', new Route(constant('URL_SUBFOLDER') . '/conference_detail/{id}', array('controller' => 'ConferenceController', 'method'=>'conference_detail'), array('id' => '[0-9]+','type' => '[0-9]+')));
    $routes->add('add_conferences', new Route(constant('URL_SUBFOLDER') . '/add_conferences', array('controller' => 'ConferenceController', 'method'=>'add_conferences'), array()));
    $routes->add('history', new Route(constant('URL_SUBFOLDER') . '/history', array('controller' => 'PageController', 'method'=>'history'), array()));
    $routes->add('reports', new Route(constant('URL_SUBFOLDER') . '/reports', array('controller' => 'PageController', 'method'=>'reports'), array()));
    $routes->add('notifications', new Route(constant('URL_SUBFOLDER') . '/notifications', array('controller' => 'PageController', 'method'=>'notifications'), array()));
    $routes->add('contact_support', new Route(constant('URL_SUBFOLDER') . '/contact_support', array('controller' => 'PageController', 'method'=>'contact_support'), array()));
}
$routes->add('conference_companies', new Route(constant('URL_SUBFOLDER') . '/conference_companies/{user_id}/{type}', array('controller' => 'ConferenceController', 'method'=>'conferenceCompanies'), array('user_id' => '[0-9]+','type' => '[0-9]+')));
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method'=>'index'), array()));
$routes->add('aboutus', new Route(constant('URL_SUBFOLDER') . '/aboutus', array('controller' => 'PageController', 'method'=>'aboutus'), array()));
$routes->add('services', new Route(constant('URL_SUBFOLDER') . '/services', array('controller' => 'PageController', 'method'=>'services'), array()));
$routes->add('portfolio', new Route(constant('URL_SUBFOLDER') . '/portfolio', array('controller' => 'PageController', 'method'=>'portfolio'), array()));
$routes->add('pricing', new Route(constant('URL_SUBFOLDER') . '/pricing', array('controller' => 'PageController', 'method'=>'pricing'), array()));

$routes->add('route_error', new Route(constant('URL_SUBFOLDER') . '/route_error', array('controller' => 'PageController', 'method'=>'route_error'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . '/login', array('controller' => 'PageController', 'method'=>'login'), array()));
$routes->add('logout', new Route(constant('URL_SUBFOLDER') . '/logout', array('controller' => 'PageController', 'method'=>'logout'), array()));
$routes->add('register', new Route(constant('URL_SUBFOLDER') . '/register', array('controller' => 'PageController', 'method'=>'register'), array()));
$routes->add('forgotPassword', new Route(constant('URL_SUBFOLDER') . '/forgotPassword', array('controller' => 'PageController', 'method'=>'forgotPassword'), array()));
//$routes->add('submit_registration', new Route(constant('URL_SUBFOLDER') . '/submit_registration', array('controller' => 'PageController', 'method'=>'submit_registration'), array(),['POST']));