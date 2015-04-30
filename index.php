<?php
include_once './includes/config.php';
include_once './controllers/BaseController.php';


define('DX_ROOT_DIR', dirname(__FILE__). '/'); // C:/ .../phonebook
define('DX_ROOT_PAHT', basename(dirname(__FILE__)) . '/'); //  phonebook/'

$request = $_SERVER['REQUEST_URI'];
$requestHome = '/' . DX_ROOT_PAHT;
$requestParts = explode('/', parse_url($request, PHP_URL_PATH));

$controller = DEFAULT_CONTROLLER;
$method = DEFAULT_METHOD;
$params = array();
$logged_routing = false;

//var_dump($requestParts); die();

if (count($requestParts) >= 1 && !empty($requestParts[1])) {    
    $controller = $requestParts[1];
}

if (count($requestParts) >= 2 && !empty($requestParts[2])) {
    $method = $requestParts[2];
}

if (count($requestParts) >= 3 && !empty($requestParts[3])) {
    $params = array_splice($requestParts, 2);
}

$controllerClassName = ucfirst ($controller) . 'Controller';
$controllerFile = ucfirst ($controller) . 'Controller.php';

if (count($requestParts) > 1 && file_exists('controllers/' . $controllerFile)) {
    include_once 'controllers/' . $controllerFile;
}

$controllerFullName = '\Controllers\\' . $controllerClassName;
if (class_exists($controllerFullName)) {
    $controllerInstance = new $controllerFullName($controller, $method);
} else {
    die("Cannot find controller $controller.");
}

if (method_exists($controllerInstance, $method)) {
    call_user_func_array(array($controllerInstance, $method), array($params));
} else {
    die("Cannot find method $method in controller $controllerClassName ");
}

$controllerInstance->renderView();