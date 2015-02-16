<?php

namespace Tzewangdorje\Netsapiens;


class ResourcePhonenumber extends Resource {

    public function read (array $params)
    {
        $bodyParams = [
            'object' => "phonenumber",
            'action' => "read",
            'dest_domain' => $params["domain"],
            'to_user' => $params["to-user"],
            'plan' => $params["plan"],
        ];
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
            'object' => "phonenumber",
            'action' => "create",
            'dest_domain' => $params["domain"],
            'domain' => $params["domain"],
            'to_user' => $params["to-user"],
            'dialplan' => $params["plan"],
            'matchrule' => $params["match"],
            'responder' => "sip:start@to-user",
        ];
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => $bodyParams,
        ]);
    }
}