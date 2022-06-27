<?php

namespace App\Models;

use RedBeanPHP\R;

class BaseModel
{

    public function getByPk($id){
        $query = "select * from $this->table where id =$id LIMIT 1";
        $user  = R::getAssocRow($query);
        return $user[0];
    }
}
