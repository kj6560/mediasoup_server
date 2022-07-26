<?php

namespace App\Models;

use RedBeanPHP\R;

class Organisation extends BaseModel
{
    public $id;
    public $name;
    public $address;
    public $mobile;
    public $passphrase;
    public $is_available;
    public $created_at;
    public $updated_at;
    public $is_deleted;
    public $table = "organisation";
    protected $validation_rule = array(
        "passphrase" => ['required', 'string']
    );
}
