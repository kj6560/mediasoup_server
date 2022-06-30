<?php 

namespace App\Controllers;

use App\Models\Product;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class PageController extends Controller
{
    // Homepage action
	public function index(RouteCollection $routes)
	{
		$this->loadView('general_layout','pages/home',array());
	}
	// login action
	public function login(RouteCollection $routes)
	{
		$this->loadView('general_layout','pages/login',array());
	}
	// register action
	public function register(RouteCollection $routes)
	{
		$this->loadView('general_layout','pages/register',array());
	}
	// submit_registration action
	public function submit_registration(RouteCollection $routes)
	{
		$data = $_POST;
		$user = new User;
		$user->name = $data['name'];
		$user->email = $data['email'];
		$user->password = password_hash($data['password'], PASSWORD_DEFAULT);
		$user->mobile = $data['mobile'];
		$user->organisation = 1;
		$user->is_admin=0;
		$user->is_available = 1;
		$user->user_role = 1;
		$user->parent = 0;
		$user_created = $user->create();
		print_r($user_created);
	}
}