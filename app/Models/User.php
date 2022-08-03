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
    protected $validation_rule = array(
        "name" => ['required', 'string']
    );

    public function getAllUsersInOrganisation($organisation)
    {
        $query = "select users.id as id,users.name as user_name,organisation.name as org_name, users.is_available as user_status,users.user_role as role,organisation.parent as org_parent,organisation.id as org_id from users right join organisation on users.organisation=organisation.id where organisation.id=$organisation or organisation.parent=$organisation and users.name != '' and users.is_deleted =0 ";
        $users  = R::getAssocRow($query);
        return !empty($users) ? $users : false;
    }
    public function getAllOrganisationFor($organisation)
    {
        $query = "select * from organisation where organisation.id=$organisation or organisation.parent=$organisation and organisation.is_available=1 and organisation.is_delete=0 order by organisation.id desc";
        $org  = R::getAssocRow($query);
        return !empty($org) ? $org : false;
    }

    public function getAllUserClients($organisation)
    {
        $query = "select * from organisation where organisation.parent=$organisation and organisation.is_deleted !=1 ";
        $users  = R::getAssocRow($query);
        return !empty($users) ? $users : false;
    }
}
