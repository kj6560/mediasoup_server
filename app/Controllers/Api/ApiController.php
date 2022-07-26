<?php

namespace App\Controllers\Api;

use App\Auth;

class ApiController
{
    public $response = array();
    public function getData()
    {
        return empty($_GET) ? $_GET : $_POST;
    }
    public function sendResponse()
    {
        header('Content-type: application/json');
        echo json_encode($this->response);
    }
    public function verifyToken($token)
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
