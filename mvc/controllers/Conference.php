<?php

class Conference extends Controller
{

    public $data;
    public function __construct()
    {
        print_r($this->loadModel(get_class($this)));exit;
        $this->data = $this->loadModel(get_class($this));
        print_r($this->data);
    }
    public function index($params)
    {
        
    }
}
