<?php 
namespace App\Models;
use RedBeanPHP\R;
class BaseModel
{
	
    public function getWhere($table,$params){
        $clause = "";
        foreach($params as $key=>$param){
            $clause.=$key."=".$param." ";
        }
        $data = R::getAll(
            'SELECT * FROM '.$table.' where '.$clause);
            return $data;
    }
	
}