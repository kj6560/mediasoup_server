<?php

namespace App\Controllers\Api;

use App\Auth;

class ApiController
{
    public $response=array();
    public function getData(){
        return $_REQUEST;
    }
    public function getToken(){
        return $_GET;
    }
    public function postToken(){
        return $_POST;
    }
    public function sendResponse(){
        header('Content-type: application/json');
        echo json_encode($this->response);
    }
    public function verifyToken($token){
        print_r($_POST);
        if(!empty($token)){
            $auth = new Auth;
            $org = $auth->apiGuard($token);
            return $org;
        }else{
            return false;
        }
    }
}
