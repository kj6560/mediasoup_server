<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;
class ConferenceController extends Controller
{
    
	public function readConference(int $id, RouteCollection $routes)
	{
        $conf = new Conference;
		$conf->readConferences();
        $this->loadView('general_layout','conference/product',array("conference"=>array()));
	}
}