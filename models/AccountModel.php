<?php

class AccountModel extends BaseModel {
    
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'users'));
    }
}
