<?php

namespace Orbtalk;
use GuzzleHttp\Client;


class NetsapObj {

    protected $_apiUri = "https://orbtalk.netsapiens.com/ns-api/";
    protected $_clientId = "orbtalk";
    protected $_clientSecret = "44689f17ee1830723d5b92b6bda85399";
    protected $_client;

    public function __construct ()
    {
        $this->_client = new Client();
    }
}