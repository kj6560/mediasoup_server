<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends Controller
{
    
	public function readConference(int $id, RouteCollection $routes)
	{
        $conference = new Conference();
        $this->loadView('/views/product',array("conference"=>$conference));
	}
}