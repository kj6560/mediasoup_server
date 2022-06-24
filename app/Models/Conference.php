<?php 
namespace App\Models;
use RedBeanPHP\R;
use RedBeanPHP\SimpleModel;
class Conference
{
	
    public function readConferences(){
        $conference = R::getAll(
            'SELECT * FROM conference');
        print_r($conference);
    }
	
}