<?php 

    class Conference extends Controller{

        public function __construct(){
           // parent::__construct(get_class($this));
        }
        public function index($params){
            echo "reached here";
            //print_r($this->model->select("conference"));
        }
    }
