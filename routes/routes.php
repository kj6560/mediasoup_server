<?php

use App\Auth;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

// Main Routes system
$routes = new RouteCollection();
$auth = new Auth;
if ($auth->guard('user')) {
    $routes->add('dashboard', new Route(constant('URL_SUBFOLDER') . '/dashboard', array('controller' => 'PageController', 'method' => 'dashboard'), array()));

    //user routes
    $routes->add('users', new Route(constant('URL_SUBFOLDER') . '/users', array('controller' => 'UserController', 'method' => 'users'), array()));
    $routes->add('add_users', new Route(constant('URL_SUBFOLDER') . '/add_users', array('controller' => 'UserController', 'method' => 'add_users'), array()));
    $routes->add('add_users_upload', new Route(constant('URL_SUBFOLDER') . '/add_users_upload', array('controller' => 'UserController', 'method' => 'add_users_upload'), array()));
    $routes->add('add_users_upload_file', new Route(constant('URL_SUBFOLDER') . '/add_users_upload_file', array('controller' => 'UserController', 'method' => 'add_users_upload_file'), array(), ['POST']));
    $routes->add('user_edit', new Route(constant('URL_SUBFOLDER') . '/user_edit/{id}', array('controller' => 'UserController', 'method' => 'user_edit'), array()));
    $routes->add('user_delete', new Route(constant('URL_SUBFOLDER') . '/user_delete/{id}', array('controller' => 'UserController', 'method' => 'user_delete'), array('id' => '[0-9]+')));
    $routes->add('user_status', new Route(constant('URL_SUBFOLDER') . '/user_status/{id}/{status}', array('controller' => 'UserController', 'method' => 'user_status'), array('id' => '[0-9]+', 'status' => '[0-9]+')));
    $routes->add('downloadUserUploadTemplate', new Route(constant('URL_SUBFOLDER') . '/downloadUserUploadTemplate', array('controller' => 'UserController', 'method' => 'downloadUserUploadTemplate'), array()));

    //client routes
    $routes->add('clients', new Route(constant('URL_SUBFOLDER') . '/clients', array('controller' => 'ClientController', 'method' => 'clients'), array()));
    $routes->add('add_client', new Route(constant('URL_SUBFOLDER') . '/add_client', array('controller' => 'ClientController', 'method' => 'add_client'), array()));
    $routes->add('client_delete', new Route(constant('URL_SUBFOLDER') . '/client_delete/{id}', array('controller' => 'ClientController', 'method' => 'client_delete'), array('id' => '[0-9]+')));
    $routes->add('client_edit', new Route(constant('URL_SUBFOLDER') . '/client_edit/{id}', array('controller' => 'ClientController', 'method' => 'client_edit'), array('id' => '[0-9]+')));
    $routes->add('client_status', new Route(constant('URL_SUBFOLDER') . '/client_status/{id}/{status}', array('controller' => 'ClientController', 'method' => 'client_status'), array('id' => '[0-9]+', 'status' => '[0-9]+')));
    //conference routes
    $routes->add('conferences', new Route(constant('URL_SUBFOLDER') . '/conferences', array('controller' => 'ConferenceController', 'method' => 'conferences'), array()));
    $routes->add('conference_main', new Route(constant('URL_SUBFOLDER') . '/conference_main/{conf_id}', array('controller' => 'ConferenceController', 'method' => 'conference_main'), array('conf_id' => '[0-9]+', 'type' => '[0-9]+')));
    $routes->add('conference_error', new Route(constant('URL_SUBFOLDER') . '/conference_error/{conf_id}', array('controller' => 'ConferenceController', 'method' => 'conference_error'), array('conf_id' => '[0-9]+', 'type' => '[0-9]+')));
    $routes->add('conference_ended', new Route(constant('URL_SUBFOLDER') . '/conference_ended', array('controller' => 'ConferenceController', 'method' => 'conference_ended'), array()));
    $routes->add('conference_detail', new Route(constant('URL_SUBFOLDER') . '/conference_detail/{id}', array('controller' => 'ConferenceController', 'method' => 'conference_detail'), array('id' => '[0-9]+')));
    $routes->add('conference_status', new Route(constant('URL_SUBFOLDER') . '/conference_status/{id}/{status}', array('controller' => 'ConferenceController', 'method' => 'conference_status'), array('id' => '[0-9]+', 'status' => '[0-9]+')));
    $routes->add('add_conferences', new Route(constant('URL_SUBFOLDER') . '/add_conferences', array('controller' => 'ConferenceController', 'method' => 'add_conferences'), array()));
    $routes->add('conference_edit', new Route(constant('URL_SUBFOLDER') . '/conference_edit/{id}', array('controller' => 'ConferenceController', 'method' => 'conference_edit'), array()));
    $routes->add('conference_delete', new Route(constant('URL_SUBFOLDER') . '/conference_delete/{id}', array('controller' => 'ConferenceController', 'method' => 'conference_delete'), array('id' => '[0-9]+')));
    $routes->add('endSession', new Route(constant('URL_SUBFOLDER') . '/endSession', array('controller' => 'ConferenceController', 'method' => 'endSession'), array(), ['POST']));


    //Log routes
    $routes->add('access_logs', new Route(constant('URL_SUBFOLDER') . '/access_logs', array('controller' => 'LogController', 'method' => 'accessLogs'), array()));
    $routes->add('activity_log', new Route(constant('URL_SUBFOLDER') . '/activity_log', array('controller' => 'LogController', 'method' => 'activityLog'), array()));


    //priviledged general routes
    $routes->add('history', new Route(constant('URL_SUBFOLDER') . '/history', array('controller' => 'ConferenceController', 'method' => 'history'), array()));
    $routes->add('reports', new Route(constant('URL_SUBFOLDER') . '/reports', array('controller' => 'PageController', 'method' => 'reports'), array()));
    $routes->add('notifications', new Route(constant('URL_SUBFOLDER') . '/notifications', array('controller' => 'PageController', 'method' => 'notifications'), array()));
    $routes->add('contact_support', new Route(constant('URL_SUBFOLDER') . '/contact_support', array('controller' => 'PageController', 'method' => 'contact_support'), array()));
}
//$routes->add('conference_secondary', new Route(constant('URL_SUBFOLDER') . '/conference_secondary/{conf_id}/{user_id}', array('controller' => 'ConferenceController', 'method' => 'conference_secondary'), array('conf_id' => '[0-9]+', 'user_id' => '[0-9]+')));
$routes->add('conference_room', new Route(constant('URL_SUBFOLDER') . '/conference_room/{conf_id}', array('controller' => 'ConferenceController', 'method' => 'conference_room'), array('conf_id' => '[0-9]+', 'user_id' => '[0-9]+', 'session_id' => '[0-9]+')));
//page routes
$routes->add('homepage', new Route(constant('URL_SUBFOLDER') . '/', array('controller' => 'PageController', 'method' => 'index'), array()));
$routes->add('aboutus', new Route(constant('URL_SUBFOLDER') . '/aboutus', array('controller' => 'PageController', 'method' => 'aboutus'), array()));
$routes->add('services', new Route(constant('URL_SUBFOLDER') . '/services', array('controller' => 'PageController', 'method' => 'services'), array()));
$routes->add('portfolio', new Route(constant('URL_SUBFOLDER') . '/portfolio', array('controller' => 'PageController', 'method' => 'portfolio'), array()));
$routes->add('pricing', new Route(constant('URL_SUBFOLDER') . '/pricing', array('controller' => 'PageController', 'method' => 'pricing'), array()));

//general
$routes->add('route_error', new Route(constant('URL_SUBFOLDER') . '/route_error', array('controller' => 'PageController', 'method' => 'route_error'), array()));
$routes->add('login', new Route(constant('URL_SUBFOLDER') . '/login', array('controller' => 'PageController', 'method' => 'login'), array()));
$routes->add('logout', new Route(constant('URL_SUBFOLDER') . '/logout', array('controller' => 'PageController', 'method' => 'logout'), array()));
$routes->add('register', new Route(constant('URL_SUBFOLDER') . '/register', array('controller' => 'PageController', 'method' => 'register'), array()));
$routes->add('forgotPassword', new Route(constant('URL_SUBFOLDER') . '/forgotPassword', array('controller' => 'PageController', 'method' => 'forgotPassword'), array()));
//$routes->add('submit_registration', new Route(constant('URL_SUBFOLDER') . '/submit_registration', array('controller' => 'PageController', 'method'=>'submit_registration'), array(),['POST']));


//api routes

//generate token
$routes->add('generate_token', new Route(constant('URL_SUBFOLDER') . '/v1/generate_token', array('controller' => 'Api\UserController', 'method' => 'generate_token'), array(), ['POST']));

//user
$routes->add('create_user', new Route(constant('URL_SUBFOLDER') . '/v1/create_user', array('controller' => 'Api\UserController', 'method' => 'add_users'), array(), ['POST']));
$routes->add('user_list', new Route(constant('URL_SUBFOLDER') . '/v1/user_list', array('controller' => 'Api\UserController', 'method' => 'user_list'), array(), ['POST']));
$routes->add('user_delete_api', new Route(constant('URL_SUBFOLDER') . '/v1/user_delete', array('controller' => 'Api\UserController', 'method' => 'user_delete'), array(), ['POST']));

//clients
$routes->add('create_client', new Route(constant('URL_SUBFOLDER') . '/v1/create_client', array('controller' => 'Api\UserController', 'method' => 'create_client'), array(), ['POST']));
$routes->add('client_delete_api', new Route(constant('URL_SUBFOLDER') . '/v1/client_delete', array('controller' => 'Api\UserController', 'method' => 'client_delete'), array(), ['POST']));
$routes->add('client_list', new Route(constant('URL_SUBFOLDER') . '/v1/client_list', array('controller' => 'Api\UserController', 'method' => 'client_list'), array(), ['POST']));

//conference
$routes->add('create_conf', new Route(constant('URL_SUBFOLDER') . '/v1/create_conf', array('controller' => 'Api\ConferenceController', 'method' => 'create_conf'), array(), ['POST']));
$routes->add('conf_list', new Route(constant('URL_SUBFOLDER') . '/v1/conf_list', array('controller' => 'Api\ConferenceController', 'method' => 'conf_list'), array(), ['POST']));
$routes->add('conf_delete', new Route(constant('URL_SUBFOLDER') . '/v1/conf_delete', array('controller' => 'Api\ConferenceController', 'method' => 'conf_delete'), array(), ['POST']));


//mobile app apis

$routes->add('app_login', new Route(constant('URL_SUBFOLDER') . '/v1/app_login', array('controller' => 'Api\AppController', 'method' => 'app_login'), array(), ['POST']));
