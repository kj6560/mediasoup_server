<?php

namespace App\Controllers;

use App\Auth;
use App\Models\IPLog;

class Controller
{
    public function __construct()
    {
        $ip_address = $this->getUserIP();
        $log = new IPLog;
        $log->ip_address = $ip_address;
        $is_log = $log->getByAttributes(array('ip_address' => $ip_address));
        if ($is_log) {
            $log->id = $is_log['id'];
            $log->update();
        } else {
            $log->create();
        }
    }
    public function loadView($layout, $view, $data = [])
    {
        $data['view'] = APP_ROOT . "/views/" . $view . ".php";
        if (!empty($_SESSION['login_id'])) {
            $data['current_user'] = $user = Auth::logger('user');
        }
        if (count($data)) {
            extract($data);
        }
        require APP_ROOT . "/views/layouts/" . $layout . ".php";
    }
    private function getUserIP()
    {

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }
}
