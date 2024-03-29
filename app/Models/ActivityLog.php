<?php

namespace App\Models;

use RedBeanPHP\R;

class ActivityLog extends BaseModel
{
    public $id;
    public $table = "activitylog";
    public function getAllActivityLog()
    {
        $query = "select activitylog.*,u.name as activity_by_name from activitylog inner join users u on activitylog.activity_by = u.id where activitylog.is_deleted !=1 order by activitylog.id desc";
        $acttivity_logs  = R::getAssocRow($query);
        return !empty($acttivity_logs) ? $acttivity_logs : false;
    }
}
