<?php
namespace App;
use RedBeanPHP\R;
class ViewHelpers
{
    public static function getParticipants($user_ids){
        $query = "select name from users where id in ($user_ids)";
        $users  = R::getAssocRow($query);
        $participants = array();
        foreach($users as $participant){
            array_push($participant['name']);
        }
        return implode(",",$participants);
    }
}
