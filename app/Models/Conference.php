<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	
    public function readConferences($user_id,$type){
        $query = "select * from conference where conference_for in ($user_id) and conference_type=$type LIMIT 1";
        $conference  = R::getAssocRow($query);
        return !empty($conference)?$conference[0]:false;
    }
    public function readConferencesForCompanies($user_id,$type){
        $query = "select * from conference where conference_for in ($user_id) and conference_type=$type LIMIT 1";
        $conference  = R::getAssocRow($query);
        return !empty($conference)?$conference[0]:false;
    }
    public function getUserById($user_id){
        $query = "select * from users where id =$user_id LIMIT 1";
        $user  = R::getAssocRow($query);
        return !empty($user)?$user[0]:false;
    }
	
}