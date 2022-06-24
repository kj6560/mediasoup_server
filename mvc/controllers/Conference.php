<?php

class Conference extends Controller
{

    public $model;
    public function __construct()
    {
        $this->model = $this->loadModel(get_class($this));
    }
    public function index($params)
    {
        print_r($this->model);
    }
}
