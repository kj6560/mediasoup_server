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
		if (AppHelpers::isMaster($user['user_role'])) {
			$all_clients = $users->getAllUserClientsForMaster();
		} else {
			$all_clients = $users->getAllUserClients($organisation);
		}

		$this->loadView('dashboard_layout', 'dashboard/dashboard_clients', array("clients" => $all_clients));
	}

	//client add action
	public function add_client(RouteCollection $routes)
	{
		$data = $_POST;
		$msg = "";
		$code = 0;
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$user_org = new Organisation;
		$user_org->id = $organisation;
		$user_org = $user_org->getByPk();
		if ($user_org['parent'] > 1) {
			AppHelpers::redirect("/clients");
		}
		if (!empty($data)) {
			$org = new Organisation;
			$org->name = $data['name'];
			$org->address = $data['address'];
			$org->mobile = $data['mobile'];
			$org->passphrase = md5($data['passphrase']);
			$org->admin = 1;
			$org->is_available = 1;
			$org->parent = $organisation;
			$client = $org->create();

			$activity_type = 9;
			$ref_id =  $client['id'];
			$activity_by = $user['id'];
			$remarks = $user['name'] . " created client " . $data['name'];
			$log = AppHelpers::logActivity($activity_type, $ref_id, $activity_by, $remarks);

			if ($client && $log) {
				$msg = "Client created successfully";
				$code = 1;
			} else {
				$msg = "Client creation failed";
			}
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_client', array("page_heading" => "Add Client", "msg" => array('text' => $msg, 'code' => $code)));
	}
	//client detail action
	public function client_detail($id, RouteCollection $routes)
	{
		$user = new User;
		$user->id = $id;
		$users = $user->getByPk();
		$this->loadView('dashboard_layout', 'dashboard/dashboard_user_detail', array("page_heading" => "User Detail"));
	}
	//client status action
	public function client_status($id, $status, RouteCollection $routes)
	{
		$user = R::load('organisation', $id);
		$user->is_available = $status == 1 ? 0 : 1;
		$usr = R::store($user);
		if ($usr) {
			AppHelpers::redirect('/clients');
		}
	}
	//client edit action
	public function client_edit($id, RouteCollection $routes)
	{
		$data = $_POST;
		$msg = "";
		$code = 0;
		$clientToEdit = new Organisation;
		$clientToEdit->id = $id;
		$clientToEdit = $clientToEdit->getByPk();
		if (!empty($data)) {

			$user = Auth::logger('user');
			$organisation = $user['organisation'];
			$org = new Organisation;
			$org->id = $id;
			$org->name = $data['name'];
			$org->address = $data['address'];
			$org->mobile = $data['mobile'];
			if (!empty($data['passphrase'])) {
				$org->passphrase = md5($data['passphrase']);
			}
			$org->admin = 1;
			$org->is_available = 1;
			$org->is_deleted = $clientToEdit['is_deleted'];
			$org->parent = $organisation;
			$client = $org->update();

			$activity_type = 9;
			$ref_id =  $client['id'];
			$activity_by = $user['id'];
			$remarks = $user['name'] . " edited client " . $clientToEdit['name'];
			$log = AppHelpers::logActivity($activity_type, $ref_id, $activity_by, $remarks);

			if ($client && $log) {
				$msg = "Client updated successfully";
				$code = 1;
			} else {
				$msg = "Client updation failed";
			}
			AppHelpers::redirect('/clients');
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_client', array("client" => $clientToEdit, "page_heading" => "Edit Client", "msg" => array('text' => $msg, 'code' => $code)));
	}
	//conference delete action
	public function client_delete($id, RouteCollection $routes)
	{
		$client = new Organisation;
		$client->id = $id;
		$deleted = $client->delete();
		if ($deleted) {
			AppHelpers::redirect('/clients');
		} else {
			echo "failed to delete";
		}
	}
}
