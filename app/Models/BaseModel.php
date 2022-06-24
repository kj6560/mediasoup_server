<?php 
namespace App\Models;
use RedBeanPHP\R;
class BaseModel
{
	
    public function getAll($table){
        $data = R::getAll(
            'SELECT * FROM '.$table);
            return $data;
    }
	
}