<?php

namespace App\Controllers;

use App\Auth;

class Controller
{
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
}
