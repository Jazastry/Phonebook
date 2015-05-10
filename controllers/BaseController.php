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
        $this->messages = new Messages();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (empty($_POST['formToken']) || $_POST['formToken'] != $_SESSION['formToken']) {
                $this->messages->addErrorMessage('Posible CRSF Attack .');
                exit;
            }
            
            $this->isPost = true;
        }
        
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $_SESSION['formToken'] = hash('md5', microtime());
        }
        $this->validate = new Validate();       
        $auth = Auth::get_instance();
        $this->user = $auth->get_logged_user();
        if (! empty( $this->user )) {
            $this->layoutFolder = LOGGED_LAYOUT;
            $this->viewFolder = 'logged/' . $viewFolder;
        }
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
        if (empty($controlerName)) {
            $controlerName = $this->viewFolder;
        }
        $url = '/' . urldecode($controlerName) . '/'
                . urldecode($actionName);
        if ($params != null) {
            $encodedParams = urlencode( $params );
            $url .= '/' . $encodedParams;
        }
        $this->redirectToUrl($url);
    }
}

