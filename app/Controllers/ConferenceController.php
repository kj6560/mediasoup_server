<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;
class ConferenceController extends Controller
{
    
	public function readConference(int $id, RouteCollection $routes)
	{
        $conf = new Conference;
		$conferences = $conf->readConferences();
        $this->loadView('general_layout','conference/conference',array("conference"=>$conferences));
	}
}