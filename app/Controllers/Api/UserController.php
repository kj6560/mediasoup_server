<?php

namespace App\Controllers\Api;


use App\Controllers\Api\ApiController;
use App\Models\Organisation;
use App\Models\Tokens;
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
            $token->token = md5(date('Y-m-d H:is'));
            $token->is_available = 1;
            $token = $token->create();
            if ($token) {
                $this->response['msg'] = "Token generated";
                $this->response['data'] = array("token"=>$token->token,"created_at"=>$token->created_at);
            }
        } else {
            $this->response['msg'] = "Token generation failed";
            $this->response['data'] = null;
        }
        $this->sendResponse();
    }
}
