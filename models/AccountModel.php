<?php

class AccountModel extends BaseModel {
    
    public function register($username, $password) {
        $auth = Auth::get_instance();       
        if ($auth->userExists($username)) {
            return false;            
        }
        $user = array(
            'username' => $username,
            'password' => $password
        );
                
        $this->validate->form($user);
        return $this->add($user, 'users');
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
