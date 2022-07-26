<?php

namespace App\Models;

use RedBeanPHP\R;

class Organisation extends BaseModel
{
    public $id;
    public $table = "organisation";
    protected $validation_rule = array(
        "name" => ['required', 'string']
    );
}
