<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
	public $table = "conference";
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
    public function readAllConferencesForCompanies($organisation){
        $query = "select conference.*,u.name from conference inner join users u on conference.conference_by = u.id where conference.organisation=$organisation ";
        $conference  = R::getAssocRow($query);
        return !empty($conference)?$conference:false;
    }
    // public function getUserById($user_id){
    //     $query = "select * from users where id =$user_id LIMIT 1";
    //     $user  = R::getAssocRow($query);
    //     return !empty($user)?$user[0]:false;
    // }
	
}