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
	//users action
	public function users(RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$users = new User;
		$all_users = $users->getAllUsersInOrganisation($organisation);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_users', array("users"=>$all_users));
	}
	
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
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$newuser = new User;
		$orgs = $newuser->getAllOrganisationFor($organisation);
		if (!empty($data)) {


			$newuser->name = $data['name'];
			$newuser->email = $data['email'];
			$newuser->mobile = $data['mobile'];
			$newuser->user_role = $data['role'];
			$newuser->is_available = 1;
			$newuser->organisation = $data['organisation'];
			$newuser->is_admin = $data['role'] == 1 ? 1 : 0;
			$pass_text = explode("@", $data['email'])[0];
			$newuser->password = password_hash($pass_text, PASSWORD_DEFAULT);
			$user_created = $newuser->create();
			if ($user_created) {
				$msg = "User created successfully";
				$code = 1;
			} else {
				$msg = "User creation failed";
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user', array("orgs" => $orgs, "page_heading" => "Add User", "msg" => array('text' => $msg, 'code' => $code)));
	}
	//user edit
	public function user_edit($id,RouteCollection $routes)
	{
		$data = $_POST;
		$msg = "";
		$code = 0;
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$newuser = new User;
		$orgs = $newuser->getAllOrganisationFor($organisation);
		$userToEdit = new User;
		$userToEdit->id = $id;
		$userToEdit = $userToEdit->getByPk();
		print_r($userToEdit);
		if (!empty($data)) {


			$newuser->name = $data['name'];
			$newuser->email = $data['email'];
			$newuser->mobile = $data['mobile'];
			$newuser->user_role = $data['role'];
			$newuser->is_available = 1;
			$newuser->organisation = $data['organisation'];
			$newuser->is_admin = $data['role'] == 1 ? 1 : 0;
			$pass_text = explode("@", $data['email'])[0];
			$newuser->password = password_hash($pass_text, PASSWORD_DEFAULT);
			$user_created = $newuser->create();
			if ($user_created) {
				$msg = "User created successfully";
				$code = 1;
			} else {
				$msg = "User creation failed";
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user', array("orgs" => $orgs, "page_heading" => "Add User", "msg" => array('text' => $msg, 'code' => $code)));
	}
	//user delete action
	public function user_delete($id, RouteCollection $routes)
	{
		$user = new User;
		$user->id = $id;
		$deleted = $user->delete();
		if ($deleted) {
			AppHelpers::redirect('/users');
		} else {
			echo "failed to delete";
		}
	}
}
