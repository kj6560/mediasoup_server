<?php

class Conference extends Controller
{
    private $model;
    public function __construct(){
        $this->model = $this->loadModel(get_class());
    }
    public function index($params)
    {
        print_r($this->model);
        
    }
}
