<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\IPLog;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class LogController extends Controller
{
    public function accessLogs(RouteCollection $routes)
    {
        $log = new IPLog;
        $logs = $log->getAll();
        $this->loadView('dashboard_layout', 'dashboard/dashboard_access_logs', array("logs" => $logs, "page_heading" => "Access Ip History"));
    }
}
