<?php

class AccountController extends BaseController {
    private $db;
    
    public function __construct($viewFolder) {
        parent::__construct(get_class());
        $this->db = new AccountModel();
        $this->viewFolder = $viewFolder;
    }
    public function register() {
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $isRegistred = $this->db->register($username, $password);
            if ($isRegistred) {
                $this->redirect('phones');
            } else {
                $this->addErrorMessage('Register failed.');
            } 
        }        

        $this->renderView($this->viewFolder, __FUNCTION__);
    }
    
    public function login() {
              
        $this->renderView($this->viewFolder, __FUNCTION__);
    } 
}
