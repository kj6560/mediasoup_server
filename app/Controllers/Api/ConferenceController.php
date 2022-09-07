<?php

namespace App\Controllers\Api;

use App\Auth;
use App\Controllers\Api\ApiController;
use App\Controllers\EmailController;
use App\Models\Conference;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class ConferenceController extends ApiController
{


	//add conference action
	public function create_conf(RouteCollection $routes)
	{
		// $org = $this->verifyToken();
		// if ($org) {
		$data = $_POST;
		$conf_for = explode(",", $data['conference_for']);
		$conf = new Conference;
		$conf->title = $data['title'];
		$conf->conference_by = $data['user_id'];
		$conf->conference_for = implode(",", $conf_for);
		$conf->conference_date = $data['conference_date'];
		$conf->conference_type = $data['conference_type'];
		$conf->conference_duration = $data['duration'];
		$conf->organisation = 1;
		$conf->conference_room_id = rand(1000, 1000000);
		$key_map = array();

		foreach ($conf_for as $conf_user) {
			$key_map[$conf_user] = password_hash($conf_user . $conf->conference_room_id, PASSWORD_DEFAULT);
			$conf_em_user = new User;
			$conf_em_user->id = $conf_user;
			$conf_em_user = $conf_em_user->getByPk();
		}
		$conf->conference_keys = "NA";
		$conf->is_available = 1;
		$conference = $conf->create();

		if ($conference) {
			$this->response['msg'] = "conference created successfully";
			$this->response['data'] = $conference;
		} else {
			$this->response['msg'] = "conference creation failed";
			$this->response['data'] = null;
		}

		$this->sendResponse();
	}

	public function conf_list(RouteCollection $routes)
	{


		$confs = new Conference;
		if(!empty($_POST['id'])){
			$confs->id=$_POST['id'];
			$confs=$confs->getByPk();
		}else{
			$confs = $confs->readAllConferencesForCompanies(1);
		}
		
		$this->response['msg'] = "conference list fetched successfully";
		$this->response['data'] = !empty($confs) ? $confs : "Empty";
		$this->sendResponse();
	}
	public function conf_delete(RouteCollection $routes)
	{

		$data = $_POST;
		$this->response['msg'] = "conference deletion failed";
		$this->response['data'] = null;
		$conf = new Conference;
		$conf->id = $data['id'];
		$deleted = $conf->delete();
		if ($deleted) {
			$this->response['msg'] = "conference deleted successfully";
			$this->response['data'] = array('id' => $data['id']);
		}
		$this->sendResponse();
	}
}
