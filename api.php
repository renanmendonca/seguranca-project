<?php
define ('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__);
include 'vendor'.DS.'autoload.php';


if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

$route = explode('/', rtrim($_GET['request'], '/'));
$route = array_shift($route);
$route .='api';
$route = 'App\\Controllers\\Api\\'.ucwords($route);

use App\Controllers\Api\Sshapi;
use App\Controllers\Api\Cryptapi;
use App\Controllers\Api\Uploadapi;

try {
    $API = new $route($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
    
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}