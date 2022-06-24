<?php

class Conference extends Controller
{
   
    public function index($params)
    {
        $model = $this->loadModel(get_class($this));
        print_r($model);
    }
}
