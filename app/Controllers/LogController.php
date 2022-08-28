<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\ActivityLog;
use App\Models\IPLog;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class LogController extends Controller
{
    public function accessLogs(RouteCollection $routes)
    {
        $log = new IPLog;
        $logs = $log->getAll();
        $this->loadView('dashboard_layout', 'dashboard/dashboard_access_logs', array("logs" => $logs, "page_heading" => "Ip History"));
    }

    public function activityLog(RouteCollection $routes)
    {
        $log = new ActivityLog;
        $logs = $log->getAllActivityLog();
        $this->loadView('dashboard_layout', 'dashboard/dashboard_activity_logs', array("logs" => $logs, "page_heading" => "Activity History"));
    }
}
