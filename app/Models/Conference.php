<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences(){
        return $this->getAll("conference");
    }
	
}