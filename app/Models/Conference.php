<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences($user_id,$type){
        $conference  = R::find( 'conference',"conference_for in ($user_id) ");
        return $conference;
    }
	
}