<?php 
namespace App\Models;
use RedBeanPHP\R;
class Tokens extends BaseModel
{
	public $id;
    public $table = "tokens";
    public function findToken($token){
        $query = "select * from organisation inner join tokens on organisation.id = tokens.org_id where tokens.token ='".$token ."' and tokens.is_available=1 and tokens.is_deleted !=1 LIMIT 1";
        echo $query;
        $org  = R::getAssocRow($query);
        return !empty($org) ? $org[0] : false;
        
    }
}