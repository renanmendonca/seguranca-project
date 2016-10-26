<?php

define ('DS', DIRECTORY_SEPARATOR);

include 'vendor'.DS.'autoload.php';
$di = require 'service_manager.php';

$controller = 'App\\Controllers\\IndexController';

$rote = $di['router']();

if (!empty($rote->controller))
	$controller = 'App\\Controllers\\'.ucfirst($rote->controller);

$action = 'index';

if (!empty($rote->action))
	$action = $rote->action;

$controller = new $controller;
$controller->setView($di['html']());
$controller->setDi($di);

$controller->$action();