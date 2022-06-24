<?php
require "mvc/controllers/Controller.php";
class Conference extends Controller
{
   
    public function index($params)
    {
        $model = $this->loadModel(get_class($this));
        
    }
}
