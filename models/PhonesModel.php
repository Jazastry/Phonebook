<?php

class PhonesModel extends BaseModel {
    
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'phones'));
    }    
    
    public function getAll($userId) {        
        $results = $this->find();
        
        return $results;
    }
    
    public function addNew($element) {
        return $this->add($element);
    }
    
    public function customFields( $phoneId ) {
        return $this->find(
            array(
                'table' => 'custom_fields',
                'where' => 'phone_id = '. $phoneId
            )
        );      
    }
}