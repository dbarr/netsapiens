<?php

namespace Tzewangdorje\Netsapiens;


class Resource {

    protected $_apiUri;
    protected $_clientId;
    protected $_clientSecret;
    protected $_client;

    public function __construct (array $config)
    {
        $this->_apiUri = $config["apiUri"];
        $this->_clientId = $config["clientId"];
        $this->_clientSecret = $config["clientSecret"];
        $this->_client = new \GuzzleHttp\Client();
    }
}