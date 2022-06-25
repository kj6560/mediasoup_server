<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends \RedBeanPHP\SimpleModel
{
	
    public function readConferences($user_id,$type){
        $query = "select * from conference where conference_for in ($user_id) and conference_type=$type ";
        $conference  = R::getAssocRow($query);
        print_r($conference);die;
        return $conference;
    }
	
}