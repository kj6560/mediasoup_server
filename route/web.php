<?php 

// Routes system
$routes = new RouteCollection
$routes->add('conference', new Route(constant('URL_SUBFOLDER') . '/conference/{id}', array('controller' => 'ConferenceController', 'method'=>'showAction'), array('id' => '[0-9]+')));