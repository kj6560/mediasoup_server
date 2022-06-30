<?php 
namespace App\Models;
use RedBeanPHP\R;
class Organisation extends BaseModel
{
	public $id;
    public $name;
    public $address;
    public $admin;
    public $is_available;
    public $created_at;
    public $updated_at;
    public $table = "organisation";
}