<?php

class Conference extends Controller
{
    public $model;
    public function __construct(){
        try{
            $this->model = $this->loadModel(get_class($this));
            print_r($this->model);
        }catch(Exception $e){
            print_r($e->getMessage());
        }
    }
    
    public function index($params)
    {
        
       
    }
}
