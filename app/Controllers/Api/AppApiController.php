<?php

namespace App\Controllers\Api;

use RedBeanPHP\R;
use App\Auth;

class AppApiController
{
    public function __construct()
    {
        R::selectDatabase('DB1');
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
