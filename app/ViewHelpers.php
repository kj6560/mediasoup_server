<?php

namespace App;

use RedBeanPHP\R;

class ViewHelpers
{
    public static function getParticipants($user_ids)
    {
        $query = "select name from users where id in ($user_ids)";
        $users  = R::getAssocRow($query);
        $participants = array();
        foreach ($users as $participant) {
            array_push($participants, $participant['name']);
        }
        return implode(",", $participants);
    }
    public static function getOrganisation($id)
    {
        $query = "select name from organisation where id =$id";
        $org  = R::getAssocRow($query);

        return !empty($org) ? $org[0] : false;
    }
    public static function is_mobile()
    {
        $browser = get_browser(null, true);
        if (!empty($browser['ismobiledevice'])) {
            return $browser['ismobiledevice'];
        }
        return false;
    }
}
