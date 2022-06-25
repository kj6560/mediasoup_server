<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;
class ConferenceController extends Controller
{
    
	public function readConference(int $user_id,$type, RouteCollection $routes)
	{
        $conf = new Conference;
		$conferences = $conf->readConferences($user_id,$type);
		$conferences['current_user'] = $user_id;
		$user = $conf->getUserById($user_id);
		$conferences['user_name'] = $user['name'];
		print_r($conferences);
        $this->loadView('conference_layout','conference/conference',array("conference"=>$conferences));
	}
}