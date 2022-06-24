<?php

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class Controller
{
    public function loadView($layout,$view, $data = [])
    {
        $data['view'] = APP_ROOT ."/views/". $view . ".php";
        if (count($data)) {
            extract($data);
        }
        require APP_ROOT ."/views/layouts/". $layout . ".php";
    }
}
