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
        //add validation technique;
        $org = $this->verifyToken();
        if ($org) {
            $this->response['msg'] = "user creation failed";
            $this->response['data'] = null;
            $data = $_POST;
            $newuser = new User;
            $newuser->name = $data['name'];
            $newuser->email = $data['email'];
            $newuser->mobile = $data['mobile'];
            $newuser->user_role = $data['role'];
            $newuser->is_available = 1;
            $newuser->organisation = $data['organisation'];
            $newuser->is_admin = $data['role'] == 1 ? 1 : 0;
            $pass_text = explode("@", $data['email'])[0];
            $newuser->password = password_hash($pass_text, PASSWORD_DEFAULT);
            $newuser->validate();die;
            $user_created = $newuser->create();
            if ($user_created) {
                $this->response['msg'] = "user created successfully";
                $this->response['data'] = $user_created;
            }
        } else {
            $this->response['msg'] = "user creation failed. invalid or empty token";
            $this->response['data'] = null;
        }

        $this->sendResponse();
    }
}
