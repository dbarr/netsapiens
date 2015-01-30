<?php

namespace Orbtalk;


class Netsap {

    protected $_objects = array(
        "token" => array(
            "refresh"
        ),
        "subscriber" => array(
            "count", "read", "update", "create"
        ),
        "device" => array(
            "read"
        ),
        "phonenumber" => array(
            "read", "create"
        ),
    );
    protected $_objectName;
    protected $_action;
    protected $_params = array();


    public function __construct(array $args)
    {
        list($this->_objectName, $this->_action, $this->_params) = $this->_getObjectAction($args);
    }

    public function run()
    {
        $className = "\Orbtalk\NetsapObj" . ucfirst($this->_objectName);
        $object = new $className;
        try {
            $response = call_user_func_array(array($object,$this->_action), array($this->_params));
            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            if ( $statusCode != "200" || "$body"=="" ) {
                echo $statusCode . " " . $response->getReasonPhrase() . "\n";
            }
            echo $body . "\n";
        } catch (Exception $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
        }
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