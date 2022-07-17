<?php

namespace App\Controllers\Api;


class ApiController
{
    public $response=array();
    public function getData(){
        return $_POST;
    }
    public function sendResponse(){
        return json_encode($this->response);
    }
}
