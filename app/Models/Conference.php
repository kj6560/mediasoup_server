<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences($user_id,$type){
        $conference  = R::find( 'conference', " $user_id in (conference_for) ");
        return $conference;
    }
	
}