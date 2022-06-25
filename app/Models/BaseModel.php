<?php

namespace App\Models;

use RedBeanPHP\R;

class BaseModel
{

    public function getWhereIn($table, $params)
    {
        $clause = "";
        $i = 0;
        $count = count($params);
        foreach ($params as $key => $param) {
            if ($i < $count)
                $clause .= $key . "=" . $param . " and ";
            $i++;
        }
        $query = 'SELECT * FROM ' . $table . ' where ' . $clause;
        echo $query;
        $data = R::getAll(
            $query
        );
        return $data;
    }
}
