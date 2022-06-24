<?php

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class Controller
{
    public function loadView($view, $variables = [])
    {
        if (count($variables)) {
            extract($variables);
        }
        require APP_ROOT ."views/". $view . ".php";
    }
}
