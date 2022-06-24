<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences(){
        $conference = $this->getAll("conference");
        print_r($conference);
    }
	
}