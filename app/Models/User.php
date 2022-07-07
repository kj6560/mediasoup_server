<?php

namespace App\Models;

use RedBeanPHP\R;

class User extends BaseModel
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $is_available;
    public $organisation;
    public $mobile;
    public $created_at;
    public $updated_at;
    public $user_role;
    public $is_admin;
    public $parent;
    public $table = "users";
    public function getAllUsersInOrganisation($organisation)
    {
        $query = "select * from users right join organisation on users.organisation=organisation.id where organisation.id=$organisation or organisation.parent=$organisation";
        $users  = R::getAssocRow($query);
        return !empty($users) ? $users : false;
    }
}
