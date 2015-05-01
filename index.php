<?php

define('DX_ROOT_DIR', dirname(__FILE__). '/'); // C:/ .../phonebook
define('DX_ROOT_PAHT', basename(dirname(__FILE__)) . '/'); //  phonebook/'

include_once './includes/config.php';
include_once './controllers/BaseController.php';

$request = $_SERVER['REQUEST_URI'];
$requestHome = '/' . DX_ROOT_PAHT;
$requestParts = explode('/', parse_url($request, PHP_URL_PATH));

$logged_routing = false;

$controller = DEFAULT_CONTROLLER;
if (count($requestParts) >= 1 && !empty($requestParts[1])) {    
    $controller = $requestParts[1];
}

$method = DEFAULT_METHOD;
if (count($requestParts) >= 2 && !empty($requestParts[2])) {
    $method = $requestParts[2];
}

$params = array();
if (count($requestParts) >= 3 && !empty($requestParts[3])) {
    $params = array_splice($requestParts, 2);
}

$controllerClassName = ucfirst ($controller) . 'Controller';
$controllerFile = ucfirst ($controller) . 'Controller.php';

//if (count($requestParts) > 1 && file_exists('controllers/' . $controllerFile)) {
//    include_once 'controllers/' . $controllerFile;
//}


if (class_exists($controllerClassName)) {
    $controllerInstance = new $controllerClassName($controller);
} else {
    die("Cannot find controller $controller.");
}

if (method_exists($controllerInstance, $method)) {
    call_user_func_array(array($controllerInstance, $method), array($params));
} else {
    die("Cannot find method $method in controller $controllerClassName ");
}

//$match = preg_filter('/([A-Za-z_-])\w+/', $controllerFile, $controllerClassName);
function __autoload($class_name) {
    if (file_exists("controllers/$class_name.php")) {
        include "controllers/$class_name.php";
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
}