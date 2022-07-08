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
        $query = "select users.id as id,users.name as user_name,organisation.name as org_name, users.is_available as user_status,users.user_role as role,organisation.parent as org_parent from users right join organisation on users.organisation=organisation.id where organisation.id=$organisation or organisation.parent=$organisation and users.name != '' ";
        $users  = R::getAssocRow($query);
        return !empty($users) ? $users : false;
    }
    public function getAllOrganisationFor($organisation)
    {
        $query = "select * from organisation where organisation.id=$organisation or organisation.parent=$organisation ";
        $org  = R::getAssocRow($query);
        return !empty($org) ? $org : false;
    }
}
