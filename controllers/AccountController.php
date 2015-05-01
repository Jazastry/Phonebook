<?php

class AccountController extends BaseController {
    private $db;
    
    public function __construct() {
        parent::__construct(get_class());
        $this->db = new AccountModel();
    }
    public function register() {
        if ($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->db->register($username, $password);
        }
        
        $this->renderView(__FUNCTION__);
    }
    
    public function login() {
        
    } 
}
