<?php
session_start();
define('DX_ROOT_DIR', dirname(__FILE__). '/'); // C:/ .../phonebook
define('DX_ROOT_PAHT', basename(dirname(__FILE__)) . '/'); //  phonebook/'

include_once './config/bootstrap.php';
include_once './controllers/BaseController.php';

$request = $_SERVER['REQUEST_URI'];
$requestHome = '/' . DX_ROOT_PAHT;
$requestParts = explode('/', parse_url($request, PHP_URL_PATH));
$loggedRouting = false;

$validator = new Validate();
$requestParts = $validator->urlValidate($requestParts);

$controller = DEFAULT_CONTROLLER;
if (count($requestParts) >= 1 && !empty($requestParts[1])) {   
    if ($requestParts[1] == 'logged') {
        unset($requestParts[1]);
        $requestParts = array_values($requestParts);
        $loggedRouting = true;
    }
     $controller = $requestParts[1];
}

$method = DEFAULT_METHOD;
if (count($requestParts) >= 2 && !empty($requestParts[2])) {
    $method = $requestParts[2];
}

$params = array();
if (count($requestParts) >= 3 && !empty($requestParts[3])) {
    $params = array_splice($requestParts, 3);
}

$controllerClassName =  ucfirst ($controller) . 'Controller';

if (class_exists($controllerClassName)) {
    $controllerInstance = new $controllerClassName($controller);
} else {
    die("Cannot find controller $controller.");
}

if (method_exists($controllerInstance, $method)) {
    call_user_func_array(array($controllerInstance, $method), array($params));
} else {
    $messages->addInfoMessage('Wrong address.');
    $redirect('/');
//    die("Cannot find method $method in controller $controllerClassName ");
}

function __autoload($class_name) {    
    if (file_exists("controllers/$class_name.php")) {
        include "controllers/$class_name.php";
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
    if (file_exists("lib/$class_name.php")) {
        include "lib/$class_name.php";
    }
}