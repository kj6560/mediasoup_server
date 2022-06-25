<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends \RedBeanPHP\SimpleModel
{
	
    public function readConferences($user_id,$type){
        $query = "select * from conference where conference_for in ($user_id) and conference_type=$type LIMIT 1";
        $conference  = R::getAssoc($query);
        $conference = $conference[0];
        return $conference;
    }
	
}