<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\Organisation;
use App\Models\User;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;

class ClientController extends Controller
{
	//users action
	public function clients(RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$users = new User;
		$all_clients = $users->getAllUserClients($organisation);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_clients', array("clients"=>$all_clients));
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
	
}
