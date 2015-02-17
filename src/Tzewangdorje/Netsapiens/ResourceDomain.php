<?php

namespace Tzewangdorje\Netsapiens;


class ResourceDomain extends Resource {

    public function read (array $params)
    {
        $bodyParams = [
            'object' => "domain",
            'action' => "read",
        ];
        if ( isset($params["domain"]) ) {
            $bodyParams["domain"] =  $params["domain"];
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
            'object' => "domain",
            'action' => "read",
        ];
        if ( isset($params["domain"]) ) {
            $bodyParams["domain"] =  $params["domain"];
        }
        return $this->_client->post(
            $this->_apiUri, [
            'verify' => false,
            'headers' => ['Authorization' => 'Bearer ' . $params["token"]],
            'body' => $bodyParams,
        ]);
    }

}