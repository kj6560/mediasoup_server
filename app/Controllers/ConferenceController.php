<?php

namespace App\Controllers;

use App\Auth;
use App\Models\Conference;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends Controller
{

	public function conferences(RouteCollection $routes)
	{
		$conf = new Conference;
		// $conferences = $conf->readConferences($user_id, $type);
		// $conferences['current_user'] = $user_id;
		// $user = $conf->getUserById($user_id);
		// $conferences['user_name'] = $user['name'];
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$conferences = $conf->readAllConferencesForCompanies($organisation);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array("conferences" => $conferences));
		//$this->loadView('conference_layout','conference/conference',array("conference"=>$conferences));
	}
	//add conference action
	public function add_conferences(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array());
	}
	//conference detail action
	public function conference_detail($conference_id,RouteCollection $routes)
	{
		$conf = new Conference;
		$conference = $conf->getByPk($conference_id);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array('conference'=>$conference));
	}
	public function conferenceCompanies(int $user_id, $type, RouteCollection $routes)
	{
		$conf = new Conference;
		$conferences = $conf->readConferencesForCompanies($user_id, $type);
		$conferences['current_user'] = $user_id;
		$user = $conf->getUserById($user_id);
		$conferences['user_name'] = $user['name'];
		$this->loadView('conference_layout', 'conference/conference_companies', array("conference" => $conferences));
	}
}
