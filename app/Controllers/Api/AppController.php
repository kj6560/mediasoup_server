<?php

namespace App\Controllers\Api;

use App\Auth;
use App\Controllers\Api\AppApiController;
use App\Models\User;
use Symfony\Component\Routing\RouteCollection;
use RedBeanPHP\R;

class AppController extends ApiController
{
    public function app_login(RouteCollection $routes)
    {
        
        $this->response['msg'] = "login failed";
        $this->response['data'] = null;
        if ($_POST) {
            $data = $_POST;
            $user  = new User;

            $user_data = $user->getAllByAttributes(array('email' => $data['email']));
            if ($user_data) {
                if (password_verify($data['password'], password_hash($data['password'], PASSWORD_DEFAULT))) {
                    $this->response['msg'] = "login success";
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
