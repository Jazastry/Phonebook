<?php

class AccountModel extends BaseModel {
    
    public function register($username, $password) {
        $statement = self::$db->prepare("SELECT COUNT(id) FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
       
        if (count($result) > 0) {
            return false;            
        }
        return true;        
    }
    
    public function login($username, $password) {
        
    }
}
