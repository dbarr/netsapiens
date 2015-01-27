<?php

require 'vendor/autoload.php';

// TODO - if we start to use this code properly, get this to autoload in compliance with PSR standards
require_once 'Netsap.php';
require_once 'NetsapObj.php';
require_once 'NetsapObjDevice.php';
require_once 'NetsapObjSubscriber.php';
require_once 'NetsapObjToken.php';

$doc = <<<DOC
Orbtalk Netsapiens PHP Client.

Usage:
  netsapiens.php token refresh --username=<username> --password=><password>
  netsapiens.php subscriber count --token=<token> --domain=<domain>
  netsapiens.php subscriber read --token=<token> --domain=<domain> [--user=<user>] [--limit=<limit>]
  netsapiens.php subscriber update --token=<token> --domain=<domain> --user=<user> --key=<key> --value=<value>
  netsapiens.php device read --token=<token>
  netsapiens.php (-h | --help)
  netsapiens.php --version

Options:
  -h --help              Show this screen.
  --version              Show version.
  --username=<user>      Login username in user@domain format.
  --token=<token>        OAuth token generated with the "token refresh" command.
  --password=<password>  Password for the login username.
  --limit=<limit>        Limit number of returned results [default: 1].
  --user=<limit>         Subscriber user to be altered.
  --key=<limit>          Key to be altered.
  --value=<limit>        Value to set the key to.
DOC;

$response = Docopt::handle($doc, array('version'=>'Naval Fate 2.0'));

$netsap = new \Orbtalk\Netsap($response->args);
$netsap->run();
