<?php 

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Routes system
$routes = new RouteCollection();
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method'=>'indexAction'), array()));
$routes->add('conference', new Route(constant('URL_SUBFOLDER') . '/conference/{id}', array('controller' => 'ConferenceController', 'method'=>'readConference'), array('id' => '[0-9]+')));
