<?php

namespace App\Models;

use RedBeanPHP\R;

class AppUserModel extends BaseAppModel
{
    public $id;
    public $name;
    public $email;
    public $email_id;
    public $email_verified_at;
    public $password;
    public $mobile;
    public $registrant_type;
    public $companycode;
    public $companyEmpMail;
    public $term_accepted;
    public $confirm_adult;
    public $profile_img;
    public $verification_key;
    public $otp;
    public $validity;
    public $verification_status;
    public $remember_token;
    public $created_at;
    public $updated_at;
    public $session;
    public $status;
    public $subrole;

    public $table = "users";
    // protected $validation_rule = array(
    //     "name" => ['required', 'string']
    // );

    
}
