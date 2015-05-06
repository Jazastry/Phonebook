<?php

class AccountModel extends BaseModel {
    
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'users'));
    }
    
    public function register( $args ) {
        
        $result = $this->add( $args );
        
        return $result['success'];
    }
}
