<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\Conference;
use App\Models\ConferenceSession;
use App\Models\Organisation;
use App\Models\User;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends Controller
{

	public function conference_main($conf_id, RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$conf = new Conference;
		$conferences = $conf->readConferences($conf_id);
		if ($conferences['is_available']) {
			$conferences['current_user'] = $user['id'];
			$conferences['user_name'] = $user['name'];
			$this->loadView('conference_layout', 'conference/conference', array("conference" => $conferences));
		} else {
			AppHelpers::redirect('/conference_error/' . $conferences['id']);
		}
	}
	public function conference_room($conf_id,$user_id,$session_id, RouteCollection $routes)
	{
		$user = new User;
		$user->id = $user_id;
		$user = $user->getByPk();
		$conf = new Conference;
		$conferences = $conf->readConferences($conf_id);
		if ($conferences['is_available']) {
			$conferences['current_user'] = $user['id'];
			$conferences['user_name'] = $user['name'];
			$this->loadView('conference_layout', 'conference/conference', array("conference" => $conferences));
		} else {
			AppHelpers::redirect('/conference_error/' . $conferences['id']);
		}
	}
	public function conference_secondary($conf_id,$user_id, RouteCollection $routes)
	{
		$user = new User;
		$user->id = $user_id;
		$user = $user->getByPk();
		$conf = new Conference;
		$conferences = $conf->readConferences($conf_id);
		if($_POST){
			$user_passkey = $_POST['passkey'];
			$url = '/conference_error/' . $conferences['id'];
			if($conf->isAllowed($conferences['id'],$user_id,$user_passkey)){
				$conf_session = new ConferenceSession;
				$conf_session->conf_id = $conf_id;
				$conf_session->user_id = $user_id;
				$conf_session->is_deleted = 0;
				$conf_session->is_available = 1;
				$conf_session = $conf_session->create();
				$url = "/conference_room/".$conf_id."/".$user_id."/".$conf_session->id;
			}
			AppHelpers::redirect($url);
		}
		$this->loadView('conference_layout', 'dashboard/dashboard_secondary', array("user_id" => $user_id,"conf_id"=>$conf_id));
	}
	public function conference_error($conf_id, RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$conf = new Conference;
		$conferences = $conf->readConferences($conf_id);
		$msg = "";
		$code = 0;
		if (!$conferences['is_available']) {
			$msg .= "Conference is inactive";
		}
		$participants = explode(",", $conferences['conference_for']);
		if (array_search($user['id'], $participants)) {
			$msg .= "you are not a part of the conference";
		}
		$this->loadView('conference_layout', 'conference/conference_error', array("errors" => array('msg' => $msg, 'code' => $code)));
	}
	public function conferences(RouteCollection $routes)
	{
		$conf = new Conference;
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$conferences = $conf->readAllConferencesForCompanies($organisation);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array("conferences" => $conferences, "page_heading" => "Conferences"));
	}
	//add conference action
	public function add_conferences(RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$org = new Organisation;
		$org->id = $organisation;
		$org = $org->getByPk();
		$userModel = new User;
		$users = $userModel->getAllByAttributes(array('organisation' => $organisation));
		$msg = "conference creation failed";
		$code = 0;
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
			$key_map = array();
			$email_map = array();
			foreach($data['conference_for'] as $conf_user){
				$key_map[$conf_user] = password_hash($conf_user.$conf->conference_room_id, PASSWORD_DEFAULT);
				$conf_em_user = new User;
				$conf_em_user->id = $conf_user;
				$conf_em_user = $conf_em_user->getByPk();
				$email_map[$conf_user] = array("name"=>$conf_em_user['name'],"email"=>$conf_em_user['email'],"passkey"=>$conf_user.$conf->conference_room_id);
			}
			$conf->conference_keys = json_encode($key_map);
			$conf->is_available = 1;
			$conference = $conf->create();
			
			if ($conference) {
				foreach($data['conference_for'] as $conf_user){
					EmailController::send(1, 'info2018@talktoangel.com', array($user['email']), "Conference Created", "Hi ". $email_map[$conf_user]['name']." You have been invited for a conference". $data['title']." your passkey is ".$email_map[$conf_user]['passkey'].".", null, null, null, true);
				}
				$msg = "conference created successfully";
				$code = 1;
				AppHelpers::redirect('/conferences');
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_conference', array("page_heading" => "Add conference", "users" => $users, "msg" => array('text' => $msg, 'code' => $code)));
	}
	
	//add conference action
	public function conference_edit($id,RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$userModel = new User;
		$users = $userModel->getAllByAttributes(array('organisation' => $organisation));
		$msg = "conference creation failed";
		$code = 0;
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
				$code = 1;
				AppHelpers::redirect('/conferences');
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_conference', array("page_heading" => "Add conference", "users" => $users, "msg" => array('text' => $msg, 'code' => $code)));
	}
	
	//conference detail action
	public function conference_detail($id, RouteCollection $routes)
	{
		$conf = new Conference;
		$conf->id = $id;
		$conference = $conf->getByPk();
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conference_detail', array("page_heading" => "Conference Detail"));
	}
	//conference detail action
	public function conference_status($id, $status, RouteCollection $routes)
	{
		$conf = R::load('conference', $id);
		$conf->is_available = $status == 1 ? 0 : 1;
		$cnf = R::store($conf);
		if ($cnf) {
			AppHelpers::redirect('/conferences');
		}
	}

	//conference delete action
	public function conference_delete($id, RouteCollection $routes)
	{
		$conf = new Conference;
		$conf->id = $id;
		$deleted = $conf->delete();
		if ($deleted) {
			AppHelpers::redirect('/conferences');
		}else{
			echo "failed to delete";
		}
	}

}
