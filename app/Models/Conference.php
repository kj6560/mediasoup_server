<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences($user_id,$type){
        return $this->getWhere("conference",array("conference_for"=>$user_id,"conference_type"=>$type));
    }
	
}