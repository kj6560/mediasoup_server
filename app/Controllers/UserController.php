<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\Organisation;
use App\Models\User;
use Exception;
use RedBeanPHP\R;
use Symfony\Component\Routing\RouteCollection;
use \PhpOffice\PhpSpreadsheet\IOFactory;

class UserController extends Controller
{
	//users action
	public function users(RouteCollection $routes)
	{
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$users = new User;
		$all_users = $users->getAllUsersInOrganisation($organisation);
		$this->loadView('dashboard_layout', 'dashboard/dashboard_users', array("users" => $all_users));
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
	public function user_edit($id, RouteCollection $routes)
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
		if (!empty($data)) {
			$newuser->id = $id;
			$newuser->name = $data['name'];
			$newuser->email = $data['email'];
			$newuser->mobile = $data['mobile'];
			$newuser->user_role = $data['role'];
			$newuser->is_available = 1;
			$newuser->is_deleted = $userToEdit['is_deleted'];
			$newuser->organisation = $data['organisation'];
			$newuser->is_admin = $data['role'] == 1 ? 1 : 0;
			$pass_text = explode("@", $data['email'])[0];
			$newuser->password = password_hash($pass_text, PASSWORD_DEFAULT);
			$user_created = $newuser->update();
			if ($user_created) {
				$msg = "User updated successfully";
				$code = 1;
			} else {
				$msg = "User updation failed";
			}
			AppHelpers::redirect('/users');
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user', array("orgs" => $orgs, "user" => $userToEdit, "page_heading" => "Edit User", "msg" => array('text' => $msg, 'code' => $code)));
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

	//user upload
	public function add_users_upload(RouteCollection $routes)
	{

		$msg = "";
		$code = 0;
		$user = Auth::logger('user');
		$organisation = $user['organisation'];
		$newuser = new User;
		$orgs = $newuser->getAllOrganisationFor($organisation);
		try {
			if (isset($_FILES['csv'])) {
				$errors = array();
				$file_name = $_FILES['csv']['name'];
				$file_size = $_FILES['csv']['size'];
				$file_tmp = $_FILES['csv']['tmp_name'];
				$file_type = $_FILES['csv']['type'];
				$file_ext = strtolower(end(explode('.', $_FILES['csv']['name'])));

				$extensions = array("jpeg", "jpg", "png");

				if (in_array($file_ext, $extensions) === false) {
					$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
				}

				if ($file_size > 2097152) {
					$errors[] = 'File size must be excately 2 MB';
				}

				if (empty($errors) == true) {
					move_uploaded_file($file_tmp, "images/" . $file_name);
					echo "Success";
				} else {
					print_r($errors);
				}
			}
		} catch (Exception $e) {
			print_r($e->getMessage());
		}

		// $newuser->name = $data['name'];
		// $newuser->email = $data['email'];
		// $newuser->mobile = $data['mobile'];
		// $newuser->user_role = $data['role'];
		// $newuser->is_available = 1;
		// $newuser->organisation = $data['organisation'];
		// $newuser->is_admin = $data['role'] == 1 ? 1 : 0;
		// $pass_text = explode("@", $data['email'])[0];
		// $newuser->password = password_hash($pass_text, PASSWORD_DEFAULT);
		// $user_created = $newuser->create();
		// if ($user_created) {
		// 	$msg = "User created successfully";
		// 	$code = 1;
		// } else {
		// 	$msg = "User creation failed";
		// }

		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user_upload', array("page_heading" => "Add User", "msg" => array('text' => $msg, 'code' => $code)));
	}
	public function add_users_upload_file(RouteCollection $routes)
	{
		try {
			if (isset($_FILES['csv'])) {
				$file_name = rand(1, 10000) . strtolower($_FILES['csv']['name']);
				$file_tmp = $_FILES['csv']['tmp_name'];
				if (move_uploaded_file($file_tmp, "../upload/" . $file_name)) {
					$spreadsheet = IOFactory::load("../upload/" . $file_name);
					$data = $spreadsheet->getActiveSheet()->toArray();
					unlink("../upload/" . $file_name);
					$processedData = AppHelpers::processData($data);
					$beans = array();
					$existing = array();
					$errors = array();
					for ($i = 0; $i < count($processedData); $i++) {
						$pdata = $processedData[$i];
						$user = new User;
						$user = $user->getAllByAttributes(array("email" => $pdata['email']));
						if (empty($user)) {
							if (empty($pdata['email'])) {
								$errors[$i] = "Email id at row: [$i+1] is missing";
							}
							if (empty($pdata['name'])) {
								$errors[$i] = "Name  at row: [$i+1] is missing";
							}
							if (empty($pdata['mobile'])) {
								$errors[$i] = "Mobile id at row: [$i+1] is missing";
							}

							if (empty($errors[$i])) {
								$pass_text = explode("@", $pdata['email'])[0];

								$beans[$i] = R::dispense('users');
								$beans[$i]->name = $pdata['name'];
								$beans[$i]->email = $pdata['email'];
								$beans[$i]->password = password_hash($pass_text . "@123", PASSWORD_DEFAULT);
								$beans[$i]->mobile = $pdata['mobile'];
								$beans[$i]->organisation = $pdata['organisation'];
								$beans[$i]->is_available = $pdata['is_available'];
								$beans[$i]->is_deleted = $pdata['is_deleted'];
							}
						} else {
							$existing['email'] = $pdata['email'];
						}
					}

					if (!empty($existing)) {
						echo "some users already exists hence can't be stored ";
					}
					if (!empty($errors)) {
						print_r($errors);
					} else {
						R::storeAll($beans);
					}
				}
			} else {
				echo "not set";
			}
		} catch (Exception $e) {
			print_r($e->getMessage());
		}
	}
}
