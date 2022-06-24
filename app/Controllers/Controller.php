<?php

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class Controller
{
    public function loadView($layout,$view, $variables = [])
    {
        $variables['view'] = APP_ROOT ."/views/". $view . ".php";
        if (count($variables)) {
            extract($variables);
        }
        require APP_ROOT ."/views/layouts/". $layout . ".php";
    }
}
