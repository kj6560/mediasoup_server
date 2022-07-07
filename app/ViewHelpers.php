<?php
namespace App;
use RedBeanPHP\R;
class AppHelpers
{
    public static function getParticipants($user_ids){
        $query = "select name from users where id in ($user_ids)";
        $users  = R::getAssocRow($query);
        print_r($users);
    }
}
