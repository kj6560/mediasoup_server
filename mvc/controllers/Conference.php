<?php

class Conference extends Controller
{
    
    public function index($params)
    {
        try{
            $model = $this->loadModel(get_class($this));
            print_r($model);
        }catch(Exception $e){
            print_r($e->getMessage());
        }
       
    }
}
