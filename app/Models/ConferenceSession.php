<?php

namespace App\Models;

use RedBeanPHP\R;

class ConferenceSession extends BaseModel
{
    public $id;
    public $table = "conferencesessions";

    public static function isInSession($conf_id, $user_id)
    {
        $query = "select * from $this->table where conf_id =$conf_id and user_id =$user_id and is_available=1 and is_deleted !=1 LIMIT 1";
        $conf_sess  = R::getAssocRow($query);
        return !empty($conf_sess) ? $conf_sess[0] : false;
    }
}
