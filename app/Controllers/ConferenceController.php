<?php

namespace App\Controllers;

use App\Auth;
use App\Models\Conference;
use App\Models\User;
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
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array("conferences" => $conferences,"page_heading"=>"Conferences"));
		//$this->loadView('conference_layout','conference/conference',array("conference"=>$conferences));
	}
	//add conference action
	public function add_conferences(RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$userModel = new User;
		$users = $userModel->getByAttributes(array('organisation' => $organisation));
		print_r($users);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_conference', array("page_heading"=>"Add conference","users"=>$users));
	}
	//conference detail action
	public function conference_detail($id,RouteCollection $routes)
	{
		$conf = new Conference;
		$conf->id = $id;
		$conference = $conf->getByPk();
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conference_detail', array("page_heading"=>"Conference Detail"));
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
