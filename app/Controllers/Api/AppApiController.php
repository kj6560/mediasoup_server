<?php

namespace App\Controllers\Api;

use RedBeanPHP\R;
use App\Auth;

class AppApiController
{
    public function __construct()
    {
        $host = "talktoangel.com";
        $username = "radeshsuri";
        $password = "vUN%.VUu%GRE";
        $database = "ttacorporate";
        R::setup("mysql:host=$host;dbname=$database", $username, $password);
        R::freeze(TRUE);
    }
    public $response = array();
    public function getData()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? $_GET : $_POST;
    }
    public function sendResponse()
    {
        header('Content-type: application/json');
        echo json_encode($this->response);
    }
    public function verifyToken()
    {
        $data = $this->getData();
        if (!empty($data['access_token'])) {
            $auth = new Auth;
            $org = $auth->apiGuard($data['access_token']);
            return $org;
        } else {
            return false;
        }
    }
}
