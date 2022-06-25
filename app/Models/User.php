<?php 
namespace App\Models;
use RedBeanPHP\R;
class User extends BaseModel
{
	public $id;
    public function getByPk(){
        $query = "select * from users where id =$this->id LIMIT 1";
        $user  = R::getAssocRow($query);
        return $user[0];
    }
	
}