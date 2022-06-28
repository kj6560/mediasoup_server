<?php

namespace App\Models;

use RedBeanPHP\R;

class BaseModel
{

    public function getByPk(){
        $query = "select * from $this->table where id =$this->id LIMIT 1";
        $user  = R::getAssocRow($query);
        return !empty($user)?$user[0]:false;
    }
}
