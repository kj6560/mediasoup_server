<?php 

namespace App\Controllers;

use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;
class ConferenceController extends Controller
{
    
	public function conference(int $user_id,$type, RouteCollection $routes)
	{
        $conf = new Conference;
		$conferences = $conf->readConferences($user_id,$type);
		$conferences['current_user'] = $user_id;
		$user = $conf->getUserById($user_id);
		$conferences['user_name'] = $user['name'];
        $this->loadView('conference_layout','conference/conference',array("conference"=>$conferences));
	}

	public function conferenceCompanies(int $user_id,$type, RouteCollection $routes)
	{
        $conf = new Conference;
		$conferences = $conf->readConferencesForCompanies($user_id,$type);
		$conferences['current_user'] = $user_id;
		$user = $conf->getUserById($user_id);
		$conferences['user_name'] = $user['name'];
        $this->loadView('conference_layout','conference/conference_companies',array("conference"=>$conferences));
	}
}