<?php 
namespace App\Models;
use RedBeanPHP\R;
class Conference extends BaseModel
{
    public $id;
	public $table = "conference";
    public function readConferences($conf_id){
        $query = "select * from conference where id =$conf_id LIMIT 1";
        $conference  = R::getAssocRow($query);
        return !empty($conference)?$conference[0]:false;
    }
    public function readConferencesForCompanies($user_id,$type){
        $query = "select * from conference where conference_for in ($user_id) and conference_type=$type LIMIT 1";
        $conference  = R::getAssocRow($query);
        return !empty($conference)?$conference[0]:false;
    }
    public function readAllConferencesForCompanies($organisation){
        $query = "select conference.*,u.name from conference inner join users u on conference.conference_by = u.id where conference.organisation=$organisation and conference.is_deleted !=1 ";
        $conference  = R::getAssocRow($query);
        return !empty($conference)?$conference:false;
    }
    public function isAllowed($conf_id,$user_id){
        $conference = $this->readConferences($conf_id);
        

        if(!empty($conference)){
            $conference_keys = json_decode(json_encode($conference['conference_keys']), true);
            print_r($conference_keys);
            $conf_key_user = $conference_keys[$user_id];
            if(password_verify($user_id.$conference['conference_room_id'],$conf_key_user)){
                echo "match";
                return true;
            }else{
                echo "no match";
                return false;
            }
        }
    }
	
}