<?php

namespace App\Models;

use RedBeanPHP\R;

class BaseModel
{

    public function getWhere($table, $params)
    {
        $clause = "";
        $i = 0;
        $count = count($params);
        foreach ($params as $key => $param) {
            if ($i < $count)
                $clause .= $key . "=" . $param . "and ";
            $i++;
        }
        $data = R::getAll(
            'SELECT * FROM ' . $table . ' where ' . $clause
        );
        return $data;
    }
}
