<?php

class AccountModel extends BaseModel {
    
    public function register($username, $password) {
        $auth = Auth::get_instance();       
        if ($auth->userExists($username)) {
            return false;            
        }      
    }
    
    public function login($username, $password) {
        $auth = Auth::get_instance();
        $isLogged = $auth->login($username, $password);

        if ($isLogged) {
            return true;            
        }
        return false; 
    }
}
