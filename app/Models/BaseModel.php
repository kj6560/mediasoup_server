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

    public function getByAttributes($attributes)
    {
        $query = "";
        $i = 0;
        $count = count($attributes);
        foreach ($attributes as $key => $value) {
            if ($count - 1 != $i) {
                $query .= $key . " = '" . $value . "' AND ";
            } else {
                $query .= $key . " = '" . $value . "'";
            }
            $i++;
        }
        $data = R::findAll($this->table, $query);
        foreach ($data as $key => $value) {
            return $value;
        }
        return false;
    }
    public function getAllByAttributes($attributes)
    {
        $query = "select * from " . $this->table . " where ";
        $i = 0;
        $count = count($attributes);
        foreach ($attributes as $key => $value) {
            if ($count - 1 != $i) {
                $query .= $key . " = '" . $value . "' AND ";
            } else {
                $query .= $key . " = '" . $value . "'";
            }
            $i++;
        }
        $data = R::getAssocRow($query);

        return !empty($data) ? $data : false;
    }
    public function create()
    {
        $data = get_object_vars($this);
        unset($data['table']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $table = R::dispense($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $table->$key = $value;
            }
            R::store($table, true);
            return $table;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $data = get_object_vars($this);
        unset($data['table']);
        if (!empty($data['id'])) {
            $table = R::load($this->table, $data['id']);
            $table->is_available = 0;
            R::store($table, true);
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $data = get_object_vars($this);
        unset($data['table']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        if (!empty($data)) {
            $table = R::load($this->table, $data['id']);
            foreach ($data as $key => $value) {
                $table->$key = $value;
            }
            R::store($table, true);
            return $table;
        } else {
            return false;
        }
    }
}
