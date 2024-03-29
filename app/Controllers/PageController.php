<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\Organisation;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class PageController extends Controller
{
	// Homepage action
	public function index(RouteCollection $routes)
	{
		if (!empty($_SESSION['login_id'])) {
			AppHelpers::redirect('/dashboard');
		}

		//EmailController::send(1, 'info2018@talktoangel.com', array('kj6560@gmail.com'), "some test sub", "Hi there!", null, null, null, true);
		$this->loadView('general_layout', 'pages/home', array());
	}
	// login action
	public function login(RouteCollection $routes)
	{
		$return = array();
		if (!empty($_POST)) {
			$data = $_POST;
			$user  = new User;
			$user_data = $user->getByAttributes(array('email' => $data['email']));
			if ($user_data) {
				if (password_verify($data['password'], password_hash($data['password'], PASSWORD_DEFAULT))) {
					$_SESSION['login_id'] = $user_data['id'];
					AppHelpers::redirect("/dashboard");
				} else {
					$return['errors'] = "sorry your credentials are invalid";
				}
			} else {
				$return['errors'] = "User Not Found";
			}
		}
		$this->loadView('general_layout', 'pages/login', $return);
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
					$org->parent = 0;
					$org->create();
					$org_id = $org->id;
				}
			} else {
				$org_id = 0;
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
	// logout action
	public function logout(RouteCollection $routes)
	{
		if (!empty($_SESSION['login_id'])) {
			foreach ($_SESSION as $var => $value) {
				unset($_SESSION[$var]);
			}
			session_destroy();
			session_unset();
		}
		AppHelpers::redirect('/');
	}
	//dashboard action
	public function dashboard(RouteCollection $routes)
	{ 
		$this->loadView('dashboard_layout', 'dashboard/dashboard_index', array());
	}
	
	//conferences action
	public function conferences(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_conferences', array());
	}
	//history action
	public function history(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_history', array());
	}
	//history action
	public function reports(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_reports', array());
	}
	//notifications action
	public function notifications(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_notifications', array());
	}
	//contact_support action
	public function contact_support(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_support', array());
	}
	//contact_support action
	public function add_conferences(RouteCollection $routes)
	{
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_conference', array());
	}
	//aboutus action
	public function aboutus(RouteCollection $routes)
	{
		$this->loadView('general_layout', 'pages/aboutus', array());
	}
	//services action
	public function services(RouteCollection $routes)
	{
		$this->loadView('general_layout', 'pages/services', array());
	}
	//portfolio action
	public function portfolio(RouteCollection $routes)
	{
		$this->loadView('general_layout', 'pages/portfolio', array());
	}
	//pricing action
	public function pricing(RouteCollection $routes)
	{
		$this->loadView('general_layout', 'pages/pricing', array());
	}
	//error route action
	public function route_error(RouteCollection $routes)
	{
		echo "unauthorised or bad route";
	}
}
