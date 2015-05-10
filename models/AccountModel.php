<?php

class AccountModel extends BaseModel {
    
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'users'));
    }
    
    public function register( $args ) {
        
        $hash_pass = password_hash($args['password'], PASSWORD_BCRYPT);
        
        $argsPrepared = array(
            'username' => $args['username'],
            'password' => $hash_pass
        );
        $result = $this->add( $argsPrepared );
        
        return $result['success'];
    }
}
