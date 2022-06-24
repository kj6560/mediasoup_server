<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference
{
	
    public function readConferences(){
        $conference = R::getAll(
            'SELECT * FROM conference');
        print_r($conference);
    }
	
}