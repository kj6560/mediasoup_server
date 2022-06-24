<?php 

    class Conference extends Controller{

        public function index($params){
            //echo get_class($this);exit;
            print_r($this->loadModel(get_class($this)));
        }
    }
