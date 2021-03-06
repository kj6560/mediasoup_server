<?php

namespace App\Controllers\Api;


use App\Controllers\Api\ApiController;
use App\Models\Organisation;
use App\Models\Tokens;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;

class UserController extends ApiController
{

    public function generate_token(RouteCollection $routes)
    {
        $data = $this->getData();
        $org = new Organisation;
        $org->id = $data['org_id'];
        $post_hash = $data['api_key'];
        $org = $org->getByPk();
        if ($post_hash == $org['passphrase']) {
            $token = new Tokens;
            $token->org_id = $data['org_id'];
            $token->token = md5(date('Y-m-d'));
            $token->is_available = 1;
            $token = $token->create();
            if ($token) {
                $this->response['msg'] = "Token generated";
                $this->response['data'] = array("token" => $token->token, "created_at" => $token->created_at);
            }
        } else {
            $this->response['msg'] = "Token generation failed";
            $this->response['data'] = null;
        }
        $this->sendResponse();
    }
    public function add_client(RouteCollection $routes)
    {
        $org = $this->verifyToken();
        if ($org) {
            $data = $_POST;
            $this->response['msg'] = "client creation failed. Invalid token";
            $this->response['data'] = null;
            if (!empty($data)) {
                $user = new User;
                $user->id = $data['user_id']; //user who is creating a user for his organisation
                $user = $user->getByPk();
                $organisation = $user['organisation'];
                $org = new Organisation;
                $org->name = $data['name'];
                $org->address = $data['address'];
                $org->mobile = $data['mobile'];
                $org->admin = 0;
                $org->is_available = 1;
                $org->parent = $organisation;
                $client = $org->create();

                if ($client) {
                    $this->response['msg'] = "client created successfully";
                    $this->response['data'] = $client;
                }
            } else {
                $this->response['msg'] = "client creation failed. Invalid or empty post data";
            }
        } else {
            $this->response['msg'] = "client creation failed. Invalid token";
            $this->response['data'] = null;
        }
        $this->sendResponse();
    }
    public function add_users(RouteCollection $routes)
    {
        $org = $this->verifyToken();
        if ($org) {
            $data = $_POST;
            $newuser = new User;
            $newuser->name = $data['name'];
            $newuser->email = $data['email'];
            $newuser->mobile = $data['mobile'];
            $newuser->user_role = $data['role'];
            $newuser->is_available = 1;
            $newuser->parent = 0;
            $newuser->organisation = $data['organisation'];
            $newuser->is_admin = $data['role'] == 1 ? 1 : 0;
            $pass_text = explode("@", $data['email'])[0];
            $newuser->password = password_hash($pass_text, PASSWORD_DEFAULT);
            $validation = $newuser->validate();
            $this->response['msg'] = "user creation failed. validation error";
            $this->response['data'] = isset($validation['error']) ? $validation['error'] : "";
            if (empty($validation['error'])) {
                $user_created = $newuser->create();
                if ($user_created) {
                    $this->response['msg'] = "user created successfully";
                    $this->response['data'] = $user_created;
                }
            }
        } else {
            $this->response['msg'] = "user creation failed. invalid or empty token";
            $this->response['data'] = null;
        }

        $this->sendResponse();
    }
    public function user_list(RouteCollection $routes)
    {
        $org = $this->verifyToken();
        if ($org) {
            $data = $_POST;
            $users = new User;
            $users = $users->getAllUsersInOrganisation($org['org_id']);
            $this->response['msg'] = "user list fetched successfully";
            $this->response['data'] = !empty($users) ? $users : "Empty";
        }
        $this->sendResponse();
    }
    public function user_delete(RouteCollection $routes)
    {
        $org = $this->verifyToken();
        if ($org) {
            $data = $_POST;
            $this->response['msg'] = "user deletion failed";
            $this->response['data'] = null;
            $user = new User;
            $user->id = $data['id'];
            $deleted = $user->delete();
            if ($deleted) {
                $this->response['msg'] = "user deleted successfully";
                $this->response['data'] = array('id' => $data['id']);
            }
        }
        $this->sendResponse();
    }
    public function create_client(RouteCollection $routes)
    {
        $orga = $this->verifyToken();
        if ($orga) {
            $data = $_POST;
            $this->response['msg'] = "client creation failed";
            $this->response['data'] = null;
            if (!empty($data)) {
                $org = new Organisation;
                $org->name = $data['name'];
                $org->address = $data['address'];
                $org->mobile = $data['mobile'];
                if (!empty($data['passphrase']))
                    $org->passphrase = md5($data['passphrase']);
                $org->admin = 1;
                $org->is_available = 1;
                $org->parent = $orga['org_id'];
                $validation = $org->validate();
                if (empty($validation['error'])) {
                    $client = $org->create();
                    if ($client) {
                        $this->response['msg'] = "client creation successful";
                        $this->response['data'] = $client;
                    }
                }
            }
        }
        $this->sendResponse();
    }
    public function client_delete(RouteCollection $routes)
    {
        $org = $this->verifyToken();
        if ($org) {
            $data = $_POST;
            $this->response['msg'] = "client deletion failed";
            $this->response['data'] = null;
            $client = new Organisation;
            $client->id = $data['id'];
            $deleted = $client->delete();
            if ($deleted) {
                $this->response['msg'] = "client deleted successfully";
                $this->response['data'] = array('id' => $data['id']);
            }
        }
        $this->sendResponse();
    }
    public function client_list(RouteCollection $routes)
    {
        $org = $this->verifyToken();
        if ($org) {
            $clients = new User;
            $clients = $clients->getAllOrganisationFor($org['org_id']);
            $this->response['msg'] = "user list fetched successfully";
            $this->response['data'] = !empty($clients) ? $clients : "Empty";
        }
        $this->sendResponse();
    }
}
