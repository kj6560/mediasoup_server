<?php

namespace App\Models;

use RedBeanPHP\R;

class BaseAppModel
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
        echo $query;
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
        unset($data['validation_rule']);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $table = R::dispense($this->table);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $table->$key = $value;
            }
            $table->is_deleted = 0;
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
            $table->is_deleted = 1;
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
        unset($data['validation_rule']);
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
    public function clean_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    public function validate()
    {
        $data = get_object_vars($this);
        $rules = $data['validation_rule'];
        unset($data['validation_rule']);
        $return['error'] = array();
        if (!empty($rules)) {
            foreach ($data as $attr => $value) {
                if (!empty($value)) {
                    $this->$attr = $this->clean_data($value);
                }
                if (!empty($rules[$attr])) {
                    $rule = $rules[$attr];
                    foreach ($rule as $r) {
                        if ($r == "required") {
                            if (empty($value)) {
                                array_push($return['error'], array($attr => $r));
                            }
                        }
                    }
                }
            }
        }
        return $return;
    }
}
