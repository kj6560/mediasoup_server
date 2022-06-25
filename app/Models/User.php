<?php 
namespace App\Models;
use RedBeanPHP\R;
class User extends BaseModel
{
	public $id;
    // public function readConferences($user_id,$type){
    //     $query = "select * from conference where conference_for in ($user_id) and conference_type=$type LIMIT 1";
    //     $conference  = R::getAssocRow($query);
    //     return $conference[0];
    // }
    public function getByPk(){
        $query = "select * from users where id =$this->id LIMIT 1";
        echo $query;
        $user  = R::getAssocRow($query);
        return $user[0];
    }
	
}