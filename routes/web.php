<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Main Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method'=>'indexAction'), array()));
$routes->add('conference', new Route(constant('URL_SUBFOLDER') . '/conference/{user_id}/{type}', array('controller' => 'ConferenceController', 'method'=>'readConference'), array('user_id' => '[0-9]+','type' => '[0-9]+')));
