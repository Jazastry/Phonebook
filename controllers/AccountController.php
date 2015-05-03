<?php

class AccountController extends BaseController {
    private $db;
    
    public function __construct($viewFolder) {
        parent::__construct(get_class(), $viewFolder);
        $this->model = new AccountModel();
        $this->title = 'Register';
    }
    public function register() {
        $this->title = 'Register';
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $isRegistred = $this->model->register($username, $password);
            if ($isRegistred) {
                $this->redirect('phones');
            } else {
                $this->addErrorMessage('Register failed.');
            } 
        }        

        $this->renderView(__FUNCTION__);
    }
    
    public function login() {
        $this->title = 'Login';
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $auth = Auth::get_instance();
            $isLogged = $auth->login($username, $password);
            
            if ($isLogged) {                
                $this->redirect('phones');
            } else {
                $this->addErrorMessage('Register failed.');
                $this->redirect('account', 'register');
            } 
        }  
        
        $this->renderView(__FUNCTION__);
    }
    
    public function logout() {
        // Initialize the session.
        // If you are using session_name("something"), don't forget it now!
        session_start();

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_destroy();
        $this->redirect('home');
    }
}
