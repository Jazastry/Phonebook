<?php
include_once './includes/config.php';
include_once './controllers/BaseController.php';

define('DX_ROOT_DIR', dirname(__FILE__). '/'); // C:/ .../phonebook

define('DX_ROOT_PAHT', basename(dirname(__FILE__)) . '/'); //  phonebook/'

$request = $_SERVER['REQUEST_URI'];
$requestHome = '/' . DX_ROOT_PAHT;
$requestParts = explode('/', $request, 5);

$controller = DEFEULT_CONTROLLER;
$method = DEFEULT_METHOD;
$params = array();

var_dump($requestParts);
$controllerName = ucfirst ($controller) . 'Controller';

if (count($requestParts) >= 2 && !empty($requestParts[2])
        && file_exists('controllers/' . ucfirst($requestParts[2]) . '.php')) {
    $controller = $requestParts[2];    
}

if (count($requestParts) >= 3 && !empty($requestParts[3])) {
    $method = $requestParts[3];
}

if (count($requestParts) >= 4 && !empty($requestParts[4])) {
    $params = $requestParts[4];    
}

$controllerName = ucfirst ($controller) . 'Controller';
$controllerFile = ucfirst ($controller) . 'Controller.php';

if (count($requestParts) > 1 && file_exists('controllers/' . $controllerFile)) {
    include_once 'controllers/' . $controllerFile;
}

$controllerClass = '\Controllers\\' . $controllerName;
$instance = new $controllerClass();

if (method_exists($instance, $method)) {
    call_user_func_array(array($instance, $method), array($params));
}