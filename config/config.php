<?php
//site name
define('SITE_NAME', 'Video Conferencing Service');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'https://drrksuri.com/');

$host = "54.70.129.232";
$username = "angeltalk";
$password = "webrtc1@";
$database = "angeltalk";
R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::freeze( TRUE );

return [
    'propel' => [
        'database' => [
            'connections' => [
                'bookstore' => [
                    'adapter'    => 'mysql',
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => 'mysql:host=54.70.129.232;dbname=angeltalk',
                    'user'       => 'angeltalk',
                    'password'   => 'webrtc1@',
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'bookstore',
            'connections' => ['bookstore']
        ],
        'generator' => [
            'defaultConnection' => 'bookstore',
            'connections' => ['bookstore']
        ]
    ]
];