<?php

namespace App\Controllers;

use App\Models\Organisation;
use App\Models\Product;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class PageController extends Controller
{
	// Homepage action
	public function index(RouteCollection $routes)
	{
		$this->loadView('general_layout', 'pages/home', array());
	}
	// login action
	public function login(RouteCollection $routes)
	{
		$this->loadView('general_layout', 'pages/login', array());
	}
	// register action
	public function register(RouteCollection $routes)
	{

		if (!empty($_POST)) {
			$data = $_POST;
			if (!empty($data['organisation'])) {
				$org = new Organisation;
				$organisation = $org->getByAttributes(['name' => $data['name']]);
				if (!empty($organisation)) {
					$org_id = $organisation->id;
				} else {
					$org = new Organisation;
					$org->name = $data['name'];
					$org->mobile = $data['mobile'];
					$org->admin = 1;
					$org->is_available = 1;
					$org->create();
					$org_id = $org->id;
				}
			}
			$user = new User;
			$user->name = $data['name'];
			$user->email = $data['email'];
			$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
			$user->mobile = $data['mobile'];
			$user->organisation = $org_id;
			$user->is_admin = 0;
			$user->is_available = 1;
			$user->user_role = 1;
			$user->parent = 0;
			$user_created = $user->create();
		}

		$this->loadView('general_layout', 'pages/register', array());
	}
	
}
