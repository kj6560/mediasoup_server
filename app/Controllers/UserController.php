<?php

namespace App\Controllers;

use App\AppHelpers;
use App\Auth;
use App\Models\ActivityLog;
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
		if (AppHelpers::isMaster($user['user_role'])) {
			$all_users = $users->getAllUsersForMaster();
		} else {
			$all_users = $users->getAllUsersInOrganisation($organisation);
		}

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
			$activity_type = 1;
			$ref_id =  $user_created['id'];
			$activity_by = $user['id'];
			$remarks = $user['name'] . " created user " . $user_created['name'];
			$log = AppHelpers::logActivity($activity_type, $ref_id, $activity_by, $remarks);
			if ($log) {
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

			$activity_type = 4;
			$ref_id =  $user_created['id'];
			$activity_by = $user['id'];
			$remarks = $user['name'] . " edited user " . $userToEdit['name'];
			$log = AppHelpers::logActivity($activity_type, $ref_id, $activity_by, $remarks);
			if ($log) {
				$msg = "User created successfully";
				$code = 1;
			} else {
				$msg = "User creation failed";
			}
			AppHelpers::redirect('/users');
		}
		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user', array("orgs" => $orgs, "user" => $userToEdit, "page_heading" => "Edit User", "msg" => array('text' => $msg, 'code' => $code)));
	}
	//user delete action
	public function user_delete($id, RouteCollection $routes)
	{
		$auth_user = Auth::logger('user');
		$user = new User;
		$user->id = $id;
		$toDelete = $user->getByPk();
		$deleted = $user->delete();

		$activity_type = 3;
		$ref_id =  $id;
		$activity_by = $auth_user['id'];
		$remarks = $auth_user['name'] . " deleted user " . $toDelete['name'];
		$log = AppHelpers::logActivity($activity_type, $ref_id, $activity_by, $remarks);

		if ($deleted && $log) {
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

		$this->loadView('dashboard_layout', 'dashboard/dashboard_add_user_upload', array("page_heading" => "Upload User", "msg" => array('text' => $msg, 'code' => $code)));
	}
	public function add_users_upload_file(RouteCollection $routes)
	{
		try {
			if (isset($_FILES['csv'])) {
				$user = Auth::logger('user');
				$organisation = $user['organisation'];
				$file_name = rand(1, 10000) . strtolower($_FILES['csv']['name']);
				$file_tmp = $_FILES['csv']['tmp_name'];
				if (move_uploaded_file($file_tmp, "../upload/" . $file_name)) {
					$spreadsheet = IOFactory::load("../upload/" . $file_name);
					$data = $spreadsheet->getActiveSheet()->toArray();
					if (empty($data)) {
						AppHelpers::redirect("/add_user_upload");
					}
					unlink("../upload/" . $file_name);
					$processedData = AppHelpers::processData($data);
					$beans = array();
					$existing = array();
					$errors = array();
					$dup = array();
					$dup_data = array();
					for ($i = 0; $i < count($processedData); $i++) {
						$values = $processedData[$i];
						array_push($dup, $values['email']);
					}
					for ($i = 0; $i < count($processedData); $i++) {
						$pdata = $processedData[$i];
						if (count(array_keys($dup, $processedData[$i]['email'])) > 1) {
							$dup_data[$i]['email'] = $pdata['email'];
						} else {
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
								if (empty($pdata['user_role'])) {
									$errors[$i] = "user_role at row: [$i+1] is missing";
								}

								if (empty($errors[$i])) {
									$pass_text = explode("@", $pdata['email'])[0];

									$beans[$i] = R::dispense('users');
									$beans[$i]->name = $pdata['name'];
									$beans[$i]->email = $pdata['email'];
									$beans[$i]->password = password_hash($pass_text . "@123", PASSWORD_DEFAULT);
									$beans[$i]->mobile = $pdata['mobile'];
									$beans[$i]->organisation = $organisation;
									$beans[$i]->is_available = 1;
									$beans[$i]->is_deleted = 0;
									$beans[$i]->is_admin = 0;
									$beans[$i]->created_at = date('Y-m-d H:i:s');;
									$beans[$i]->updated_at = date('Y-m-d H:i:s');;
									$beans[$i]->user_role = $pdata['user_role'];
								}
							} else {
								$existing[$i]['email'] = $pdata['email'];
							}
						}
					}
					$msg = "";
					$code = 0;
					if (!empty($errors)) {
						foreach ($errors as $error) {
							$msg .= $error . "<br>";
						}
					} else {
						if (!empty($existing)) {
							foreach ($existing as $exist) {
								$msg .= "User with email " . $exist['email'] . " exists<br>";
							}
						}
						if (!empty($dup_data)) {
							foreach ($dup_data as $key => $value) {
								$msg .= "duplicate email " . $value['email'] . " at $key<br>";
							}
							$msg .= "if two rows has same email, none of them will be stored";
						}
						R::storeAll($beans);
					}

					$activity_type = 2;
					$activity_by = $user['id'];
					$remarks = $user['name'] . " uploaded users ";
					$log = AppHelpers::logActivity($activity_type, $ref_id, $activity_by, $remarks);

					return $this->loadView('dashboard_layout', 'dashboard/dashboard_add_user_upload', array("page_heading" => "Upload User", "msg" => array('text' => $msg, 'code' => $code)));
				}
			} else {
				$msg = "Please select a file to upload";
				return $this->loadView('dashboard_layout', 'dashboard/dashboard_add_user_upload', array("page_heading" => "Upload User", "msg" => array('text' => $msg, 'code' => $code)));
			}
		} catch (Exception $e) {
			print_r($e->getMessage());
		}
	}
	public function downloadUserUploadTemplate(RouteCollection $routes)
	{
		$file_name = "user_template.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename=' . $file_name);
		header("Content-Transfer-Encoding: UTF-8");
		$f = fopen('php://output', 'a');
		$spreadsheet = IOFactory::load("../templates/" . $file_name);
		$data = $spreadsheet->getActiveSheet()->toArray();
		fputcsv($f, $data[0]);
		fclose($f);
	}
}
