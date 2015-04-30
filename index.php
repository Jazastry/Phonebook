<?php
include_once './includes/config.php';
include_once './controllers/BaseController.php';

define('DX_ROOT_DIR', dirname(__FILE__). '/'); // C:/ .../phonebook
define('DX_ROOT_PAHT', basename(dirname(__FILE__)) . '/'); //  phonebook/'

$request = $_SERVER['REQUEST_URI'];
$requestHome = '/' . DX_ROOT_PAHT;
$requestParts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$controller = DEFEULT_CONTROLLER;
$method = DEFEULT_METHOD;
$params = array();
$logged_routing = false;

var_dump($requestParts);
$controllerClassName = ucfirst ($controller) . 'Controller';

if (count($requestParts) >= 2 && !empty($requestParts[2])) {
    if (file_exists('controllers/' . ucfirst($requestParts[2]) . 'Controller.php')) {
        $controller = $requestParts[2];
    }
}

if (count($requestParts) >= 3 && !empty($requestParts[3])) {
    $method = $requestParts[3];
}

if (count($requestParts) >= 4 && !empty($requestParts[4])) {
    $params = array_splice($requestParts, 3);
    var_dump($params);
}

$controllerClassName = ucfirst ($controller) . 'Controller';
$controllerFile = ucfirst ($controller) . 'Controller.php';

if (count($requestParts) > 1 && file_exists('controllers/' . $controllerFile)) {
    include_once 'controllers/' . $controllerFile;
}

$controllerFileName = '\Controllers\\' . $controllerClassName;
$controllerInstance = new $controllerFileName();

if (method_exists($controllerInstance, $method)) {
    call_user_func_array(array($controllerInstance, $method), array($params));
} else {
    die("Cannot find method $method in controller $controllerClassName ");
}