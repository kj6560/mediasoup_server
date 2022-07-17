<?php 
namespace App\Models;
use RedBeanPHP\R;
class Tokens extends BaseModel
{
	public $id;
    public $table = "tokens";
    public function findToken($token){
        $token  = R::find( $this->table, ' token = '.$token);
        return $token;
    }
}