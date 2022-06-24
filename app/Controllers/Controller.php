<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class Controller
{
    public function loadView($view){
        require APP_ROOT .$view.".php";
    }
}