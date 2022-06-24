<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends Controller
{
    // Show the product attributes based on the id.
	public function showAction(int $id, RouteCollection $routes)
	{
        $conference = new Conference();
        $this->loadView('/views/product',array("conference"=>$conference));
	}
}