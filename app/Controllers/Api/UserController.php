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
        $org = $org->getByPk();
        $passphrase = $data['org_passkey'];
        if (password_verify($passphrase, $org['passphrase'])) {
            $token = new Tokens;
            $token->org_id = $data['org_id'];
            $token->token = $org['passphrase'];
            $token->is_available = 1;
            $token = $token->create();
            if ($token) {
                $this->response['msg'] = "Token generated";
                $this->response['data'] = $token;
            }
        } else {
            $this->response['msg'] = "Token generation failed";
            $this->response['data'] = null;
        }
        return json_encode($this->response);
    }
}
