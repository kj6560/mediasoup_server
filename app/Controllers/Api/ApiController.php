<?php

namespace App\Controllers\Api;


class ApiController
{
    public $response=array();
    public function getData(){
        return $_POST;
    }
    public function sendResponse(){
        header('Content-type: application/json');
        echo json_encode($this->response);
    }
}
