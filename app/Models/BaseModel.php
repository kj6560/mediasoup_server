<?php

namespace App\Models;

use RedBeanPHP\R;

class BaseModel
{

    public function getByPk()
    {
        $query = "select * from $this->table where id =$this->id LIMIT 1";
        $user  = R::getAssocRow($query);
        return !empty($user) ? $user[0] : false;
    }

    public function create()
    {
        $data = get_object_vars($this);
        $table = R::dispense($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $table->$key = $value;
            }
            R::store($table);
            return $table;
        } else {
            return false;
        }
    }
}
