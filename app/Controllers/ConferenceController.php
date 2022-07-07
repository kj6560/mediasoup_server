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
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array("conferences" => $conferences, "page_heading" => "Conferences"));
		//$this->loadView('conference_layout','conference/conference',array("conference"=>$conferences));
	}
	//add conference action
	public function add_conferences(RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$userModel = new User;
		$users = $userModel->getAllByAttributes(array('organisation' => $organisation));
		$msg = "";
		if (!empty($_POST)) {
			$data = $_POST;
			$conf = new Conference;
			$conf->title = $data['title'];
			$conf->conference_by = $user['id'];
			$conf->conference_for = implode(",", $data['conference_for']);
			$conf->conference_date = $data['conference_date'];
			$conf->conference_type = $data['conference_type'];
			$conf->organisation = $organisation;
			$conf->conference_room_id = rand(1000, 1000000);
			$conf->is_available = 1;
			$conference = $conf->create();
			if ($conference) {
				$msg = "conference created successfully";
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_conference', array("page_heading" => "Add conference", "users" => $users,"msg"=>$msg));
	}
	//conference detail action
	public function conference_detail($id, RouteCollection $routes)
	{
		$conf = new Conference;
		$conf->id = $id;
		$conference = $conf->getByPk();
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conference_detail', array("page_heading" => "Conference Detail"));
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
