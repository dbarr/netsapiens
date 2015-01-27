<?php

require 'vendor/autoload.php';
require_once 'Netsap.php';
require_once 'NetsapObj.php';
require_once 'NetsapObjDevice.php';
require_once 'NetsapObjSubscriber.php';

$doc = <<<DOC
Orbtalk Netsapiens PHP Client.

Usage:
  netsapiens.php subscriber count
  netsapiens.php subscriber read [--limit=<limit>]
  netsapiens.php device read
  netsapiens.php (-h | --help)
  netsapiens.php --version

Options:
  -h --help         Show this screen.
  --version         Show version.
  --limit=<limit>   Limit number of returned results [default: 1].

DOC;

$response = Docopt::handle($doc, array('version'=>'Naval Fate 2.0'));

$netsap = new \Orbtalk\Netsap($response->args);
$netsap->run();