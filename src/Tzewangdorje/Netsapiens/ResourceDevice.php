<?php

namespace Tzewangdorje\Netsapiens;


class ResourceDevice extends Resource {

    public function read (array $params)
    {
        $bodyParams = [
            'object' => "device",
            'action' => "read",
            'owner_domain' =>  $params["domain"]
        ];
        if ( isset($params["user"]) ) {
            $bodyParams["owner"] =  $params["user"];
        }
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => $bodyParams,
        ]);
    }

    public function create (array $params)
    {
        $bodyParams = [
            'object' => "device",
            'action' => "create",
            'aor' =>  "sip:" . $params["user"] . "@" . $params["domain"],
            'owner' =>  $params["user"],
            'domain' =>  $params["domain"],
            'owner_domain' =>  $params["domain"],
        ];
        if ( isset($params["contact"]) ) {
            $bodyParams["aor"] =  "sip:" . $params["contact"] . "@" . $params["domain"];
        }
        if ( isset($params["auth-key"]) ) {
            $bodyParams["auth_key"] =  $params["auth-key"];
        }
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => $bodyParams,
        ]);
    }

    public function set_password (array $params)
    {
        $bodyParams = [
            'object' => "device",
            'action' => "update",
            'aor' =>  "sip:" . $params["contact"] . "@" . $params["domain"],
            'auth_key' =>  $params["auth-key"],
            'owner' =>  $params["user"],
            'owner_domain' =>  $params["domain"],
        ];
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => $bodyParams,
        ]);
    }

}