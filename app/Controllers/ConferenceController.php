<?php 

namespace App\Controllers;


use Symfony\Component\Routing\RouteCollection;
class ConferenceController extends Controller
{
    
	public function readConference(int $id, RouteCollection $routes)
	{
        print_r($dbParams);
        $this->loadView('general_layout','conference/product',array("conference"=>array()));
	}
}