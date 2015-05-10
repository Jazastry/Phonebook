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
        
        if ( $this->isPost ) {
            
            $username = htmlspecialchars( $_POST['username'] );
            $isRegistred = false;            
            $auth = Auth::get_instance();  
            $userExists = $auth->userExists( $username );
            $hasNoErrors = false;
            
            if (! $userExists) {                
                
                $paramsValidated = $this->validate->form( $_POST );
                $hasNoErrors = $this->messages->hasNoErrors($paramsValidated);       
                
                if ($hasNoErrors) {
                    
                    $isRegistred = $this->model->register( $paramsValidated );
                }
                
                if (! $hasNoErrors) {
                    $this->messages->extractErrors( $paramsValidated ); 
                }
            }
            
            if ($isRegistred && $hasNoErrors) {
                $this->messages->addInfoMessage( 'Successfull register. Now login.' );
                $this->redirect( 'account', 'login' );                
            } 
            if ($userExists) {
                $this->messages->addErrorMessage( 'Register failed. User with username ' 
                        . $username . ' already exists.');           
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
                $this->messages->addInfoMessage('Successfull login.');
                $this->redirect('logged/phones');
            } else {
                $this->messages->addErrorMessage('Login failed. If you don`t have account, please register first.');
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
        $this->messages->addInfoMessage('Log out successfull.');
        $this->redirect('home');
    }
}
