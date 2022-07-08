<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\Organisation;
use App\Models\User;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class UserController extends Controller
{
	//user detail action
	public function user_detail($id, RouteCollection $routes)
	{
		$user = new User;
		$user->id = $id;
		$users = $user->getByPk();
		$this->loadView('dashboard_layout', 'dashboard/dashboard_user_detail', array("page_heading" => "User Detail"));
	}
	//user status action
	public function user_status($id, $status, RouteCollection $routes)
	{
		$user = R::load('users', $id);
		$user->is_available = $status == 1 ? 0 : 1;
		$usr = R::store($user);
		if ($usr) {
			AppHelpers::redirect('/users');
		}
	}
	public function add_client(RouteCollection $routes)
	{
		$data = $_POST;
		$msg = "";
		$code = 0;
		if (!empty($data)) {

			$user = Auth::logger('user');
			$organisation = $user['organisation'];
			$org = new Organisation;
			$org->name = $data['name'];
			$org->address = $data['address'];
			$org->mobile = $data['mobile'];
			$org->admin = 1;
			$org->is_available = 1;
			$org->parent = $organisation;
			$client = $org->create();
			if ($client) {
				$msg = "Client created successfully";
				$code = 1;
			} else {
				$msg = "Client creation failed";
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_client', array("page_heading" => "Add Client", "msg" => array('text' => $msg, 'code' => $code)));
	}
	public function add_users(RouteCollection $routes)
	{
		$data = $_POST;
		$msg = "";
		$code = 0;
		if (!empty($data)) {

			$user = Auth::logger('user');
			$organisation = $user['organisation'];
			$newuser = new User;
			$newuser->name = $data['name'];
			$newuser->address = $data['address'];
			$newuser->mobile = $data['mobile'];
			$newuser->admin = 1;
			$newuser->is_available = 1;
			$newuser->organisation = $organisation;
			$client = $newuser->create();
			if ($client) {
				$msg = "User created successfully";
				$code = 1;
			} else {
				$msg = "User creation failed";
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user', array("page_heading" => "Add User", "msg" => array('text' => $msg, 'code' => $code)));
	}
}
