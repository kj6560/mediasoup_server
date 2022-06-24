<?php 

    class Conference extends Controller{

        public function __construct(){
           parent::__construct(get_class($this));
        }
        public function index($params){
            //echo get_class($this);exit;
            print_r($this->model);
        }
    }
