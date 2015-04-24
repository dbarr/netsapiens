<?php

namespace Tzewangdorje\Netsapiens;


class Client {

    protected $_objects = array(
        "token" => array(
            "refresh"
        ),
        "subscriber" => array(
            "count", "read", "update", "create"
        ),
        "device" => array(
            "read", "create", "set_password"
        ),
        "phonenumber" => array(
            "read", "create"
        ),
        "domain" => array(
            "read"
        ),
    );
    protected $_objectName;
    protected $_action;
    protected $_params = array();
    protected $_config = array();


    public function __construct(array $args, array $config=array() )
    {
        if ( ! is_null($config) ) {
            $this->_loadConfig($config);
        }
        list($this->_objectName, $this->_action, $this->_params) = $this->_getObjectAction($args);
    }

    protected function _loadConfig(array $config)
    {
        if ( ! isset($config["apiUri"]) ) {
            throw new \Exception("apiUri config setting missing");
        }
        $this->_config["apiUri"] = $config["apiUri"];
        if ( ! isset($config["clientId"]) ) {
            throw new \Exception("clientId config setting missing");
        }
        $this->_config["clientId"] = $config["clientId"];
        if ( ! isset($config["clientSecret"]) ) {
            throw new \Exception("clientSecret config setting missing");
        }
        $this->_config["clientSecret"] = $config["clientSecret"];
    }

    public function run()
    {
        $className = "\Tzewangdorje\Netsapiens\Resource" . ucfirst($this->_objectName);

        if (class_exists($className) === false)
            throw new Exception('Unknown resource: ' . ucfirst($this->_objectName));

        $object = new $className($this->_config);
        $response = call_user_func_array(array($object,$this->_action), array($this->_params));
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        if ( $statusCode != "200" || "$body"=="" )
            throw new \Exception($response->getResponsePhrase(), $statusCode);

        return $body;
    }

    protected function _getObjectAction (array $args)
    {
        $object = null;
        $action = null;
        $params = array();
        foreach ( $args as $arg => $argValue ) {
            if ( array_key_exists($arg, $this->_objects) && $argValue ) {
                $object = $arg;
                $actions = $this->_objects[$arg];
                foreach ( $args as $arg => $argValue ) {
                    if ( in_array($arg, $actions) && $argValue!==False ) {
                        $action = $arg;
                    }
                }
            }
        }
        // now extract the params
        foreach ( $args as $arg => $argValue ) {
            if ( substr($arg, 0, 2)=="--" && $argValue!==False && $argValue!="" ) {
                $key = substr($arg, 2);
                $params[$key] = $argValue;
            }
        }
        if ( is_null($object) ) {
            throw new \Exception("No valid Object found.");
        }
        if ( is_null($action) ) {
            throw new \Exception("No valid Action found.");
        }
        return array($object, $action, $params);
    }

}