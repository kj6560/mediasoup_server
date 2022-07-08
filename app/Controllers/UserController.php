<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\Conference;
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
		if (!empty($data)) {
			print_r($data);
			die;
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_client', array("page_heading" => "Add Client"));
	}
}
