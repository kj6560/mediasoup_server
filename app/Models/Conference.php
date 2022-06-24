<?php 
namespace App\Models;
use RedBeanPHP\R as R;
use RedBeanPHP\SimpleModel;
class Conference extends SimpleModel
{
	
    public function readConferences(){
        $conference = R::dispense("conference");
        print_r($conference);
    }
	
}