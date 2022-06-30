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
		print_r(get_object_vars($user));
	}
}