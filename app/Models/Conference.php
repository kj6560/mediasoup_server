<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences($user_id,$type){
        $conference  = R::getAll( "select * from conference where conference_for in ($user_id) and conference_type=$type ");
        return $conference;
    }
	
}