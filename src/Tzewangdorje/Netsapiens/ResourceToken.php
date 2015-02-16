<?php

namespace Tzewangdorje\Netsapiens;


class ResourceToken extends Resource {

    public function refresh (array $params)
    {
        return $this->_client->post(
            $this->_apiUri . "oauth2/token/", [
            'verify' => false,
            'body'            => [
                'client_id' => $this->_clientId,
                'client_secret' => $this->_clientSecret,
                'username' => $params["username"],
                'password' => $params["password"],
                'grant_type' => "password"
            ],
        ]);
    }
}