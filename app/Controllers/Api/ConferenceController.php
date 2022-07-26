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
		$org = $this->verifyToken();
		if ($org) {
			$data = $_POST;
			$conf_for = array($data['conference_for']);
			$conf = new Conference;
			$conf->title = $data['title'];
			$conf->conference_by = $data['user_id'];
			$conf->conference_for = implode(",", $conf_for);
			$conf->conference_date = $data['conference_date'];
			$conf->conference_type = $data['conference_type'];
			$confdur = $data['duration'];
			$conf_dur_hour = intval($confdur / 60);
			$conf_dur_min = $confdur % 60;
			$conf_dur = $conf_dur_hour . ":" . $conf_dur_min . ":00";
			$conf->conference_duration = $conf_dur;
			$conf->organisation = $org['id'];
			$conf->conference_room_id = rand(1000, 1000000);
			$key_map = array();
			$email_map = array();

			foreach ($conf_for as $conf_user) {
				$key_map[$conf_user] = password_hash($conf_user . $conf->conference_room_id, PASSWORD_DEFAULT);
				$conf_em_user = new User;
				$conf_em_user->id = $conf_user;
				$conf_em_user = $conf_em_user->getByPk();
				$email_map[$conf_user] = array("name" => $conf_em_user['name'], "email" => $conf_em_user['email'], "passkey" => $conf_user . $conf->conference_room_id);
			}
			$conf->conference_keys = json_encode($key_map);
			$conf->is_available = 1;
			$conference = $conf->create();

			if ($conference) {
				foreach ($conf_for as $conf_user) {
					$user = new User;
					$user->id = $conf_user;
					$user = $user->getByPk();
					EmailController::send(1, 'info2018@talktoangel.com', array($user['email']), "Conference Created", "Hi " . $email_map[$conf_user]['name'] . " You have been invited for a conference" . $data['title'] . " your passkey is " . $email_map[$conf_user]['passkey'] . ".", null, null, null, true);
				}
				$this->response['msg'] = "conference created successfully";
				$this->response['data'] = $conference;
			} else {
				$this->response['msg'] = "conference creation failed";
				$this->response['data'] = null;
			}
		} else {
			$this->response['msg'] = "conference creation failed. Invalid token";
			$this->response['data'] = null;
		}
		$this->sendResponse();
	}

	public function conf_list(RouteCollection $routes)
	{
		$org = $this->verifyToken();
		if ($org) {
			$this->response['msg'] = "conference list fetch failed";
			$this->response['data'] = null;
			$confs = new Conference;
			$confs = $confs->readAllConferencesForCompanies($org['id']);
			if ($confs) {
				$this->response['msg'] = "conference list fetched successfully";
				$this->response['data'] = $confs;
			}
		}
		$this->sendResponse();
	}
}
