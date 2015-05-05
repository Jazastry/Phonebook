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
            $isRegistred = false;
            
            $auth = Auth::get_instance();       
            if (! $auth->userExists($username)) {            
                $user = array(
                    'username' => $username,
                    'password' => $password
                );                
                $this->validate->form($user);
                $isRegistred = $this->model->add($user);
            }            
            
            if ($isRegistred) {
                $this->addInfoMessage('Successfull register. Now login.');
                $this->redirect('account', 'login');                
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
                $this->addInfoMessage('Successfull login.');
                $this->redirect('logged/phones');
            } else {
                $this->addErrorMessage('Login failed. If you don`t have account please register first.');
                $this->redirect('account', 'register');
            } 
        }  
        
        $this->renderView(__FUNCTION__);
    }
    
    public function logout() {
        session_start();
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        $this->addInfoMessage('Log out successfull.');
        $this->redirect('home');
    }
}
