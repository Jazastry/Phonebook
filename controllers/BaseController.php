<?php
namespace Controllers;

class BaseController {
    
    protected $controllerName;
    protected $method;
    protected $layoutFolder;
            
    function __construct($controllerName, $method) {
        $this->controllerName = $controllerName;
        $this->method = $method;
        $this->layoutFolder = DEFAULT_LAYOUT;
    }
    
    public function index() {
        //echo 'BaseController.';
    }
    
    public function renderView($viewName = null) {
        if ($viewName == null) {
            $viewName = $this->method;
        }
        
        $current_template = 'views/' 
                . $this->controllerName . '/' . $viewName . '.php';
        
        include_once 'views/layouts/'. $this->layoutFolder .'/index.php';
    }    
}

