<?php

namespace App\Controllers\Api;

use App\Auth;
use App\Controllers\Api\AppApiController;
use App\Models\AppUserModel;
use Symfony\Component\Routing\RouteCollection;

class AppController extends AppApiController
{
    public function app_login(RouteCollection $routes)
    {
        $this->response['msg'] = "login failed";
        $this->response['data'] = null;
        if ($_POST) {
            $data = $_POST;
            $user  = new AppUserModel;

            $user_data = $user->getByAttributes(array('email_d' => $data['email_id']));
            if ($user_data) {
                if (password_verify($data['password'], password_hash($data['password'], PASSWORD_DEFAULT))) {
                    $this->response['data'] = $user_data;
                } else {
                    $return['errors'] = "sorry your credentials are invalid";
                }
            } else {
                $return['errors'] = "User Not Found";
            }
        }


        $this->sendResponse();
    }
}
