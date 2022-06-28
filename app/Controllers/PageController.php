<?php 

namespace App\Controllers;

use App\Models\Product;
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
}