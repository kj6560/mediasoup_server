<?php

class Conference extends Controller
{

    public $data;
    public function __construct()
    {
        $this->data = $this->loadModel(get_class($this));
        print_r($this->data);
    }
    public function index($params)
    {
        
    }
}
