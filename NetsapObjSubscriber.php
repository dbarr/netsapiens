<?php

namespace Orbtalk;


class NetsapObjSubscriber extends NetsapObj {

    public function count (array $params)
    {
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body'            => [
                'object' => "subscriber",
                'action' => "count",
                'domain' => $params["domain"],
            ],
        ]);
    }

    public function read (array $params)
    {
        $bodyParams = [
            'object' => "subscriber",
            'action' => "read",
            'domain' => $params["domain"],
            'limit' => $params["limit"],
        ];
        if ( isset($params["user"]) ) {
            $bodyParams["user"] =  $params["user"];
        }
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => $bodyParams,
        ]);
    }

    public function update (array $params)
    {
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => [
                'object' => "subscriber",
                'action' => "update",
                'domain' => $params["domain"],
                'user' => $params["user"],
                $params["key"] => $params["value"],
            ],
        ]);
    }
}