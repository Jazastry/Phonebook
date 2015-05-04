<?php

class BaseController {
    
    protected $controllerName;
    protected $layoutFolder;
    protected $isPost = false;
    protected $viewFolder;
    protected $messages = array();
            
    function __construct($controllerName, $viewFolder) {
        $this->controllerName = $controllerName;
        $this->layoutFolder = DEFAULT_LAYOUT;
        $this->viewFolder = $viewFolder;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }        
        $this->validate = new Validate();
    }
    
    public function index() {
        //echo 'BaseController.';
    }
    
    public function renderView($viewName = DEFAULT_METHOD) {
        $current_template = 'views/' 
                . $this->viewFolder . '/' . $viewName . '.php';        
        include_once 'views/layouts/'. $this->layoutFolder .'/index.php';
    }
    
    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }
    
    public function redirect($controlerName, $actionName = DEFAULT_METHOD, $params = null) {
        $url = '/' . urldecode($controlerName) . '/'
                . urldecode($actionName);
        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }
    
    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }
}

