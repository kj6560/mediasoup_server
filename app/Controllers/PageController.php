<?php 

namespace App\Controllers;

use App\Models\Product;
use Symfony\Component\Routing\RouteCollection;

class PageController extends Controller
{
    // Homepage action
	public function indexAction(RouteCollection $routes)
	{
		$this->loadView('general_layout','pages/home',array());
	}
}