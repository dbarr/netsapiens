<?php

namespace Orbtalk;


class Netsap {

    protected $_objects = array(
        "subscriber" => array(
            "count", "read"
        ),
        "device" => array(
            "read"
        )
    );
    protected $_objectName;
    protected $_action;
    protected $_params = array("param1" => 1);


    public function __construct(array $args)
    {
        list($this->_objectName, $this->_action, $this->_params) = $this->_getObjectAction($args);
    }

    public function run()
    {
        $className = "\Orbtalk\NetsapObj" . ucfirst($this->_objectName);
        $object = new $className;
        return call_user_func_array(array($object,$this->_action), array($this->_params));
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
                    if ( in_array($arg, $actions) ) {
                        $action = $arg;
                    }
                }
            }
        }
        if ( is_null($object) ) {
            throw new Exception("No valid Object found.");
        }
        if ( is_null($action) ) {
            throw new Exception("No valid Action found.");
        }
        return array($object, $action, $params);
    }

}