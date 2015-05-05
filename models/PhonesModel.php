<?php

class PhonesModel extends BaseModel {
    
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'phones'));
    }    
    
    public function getAll($userId) {
        $args = array(
            'where' => 'user_id = ' . $userId
        );
        $results = $this->find($args);
        
        return $results;
    }
    
    public function addNew($element) {        
        $utils = new Utilities();
        
        $customFields = $utils->extractCustomFields($element);        
        $paramsCleaned = $utils->fieldsRemove($element);
        $phoneInsertResult = $this->add($paramsCleaned);
        
        $result = $phoneInsertResult;
        
        if ($phoneInsertResult['success'] && count($customFields) > 0) {
            try {
                $pairs =  $utils->extractPairs($customFields);
                $fieldsReady = $utils->fieldsKeysCleanup($pairs);
            } catch (Exception $ex) {
                throw new Exception('fields');
            }
            
            foreach ($fieldsReady as $fieldPair) {
                $fieldPair['phone_id'] = $phoneInsertResult['entryId'];
                $fieldsInsertResult = $this->add($fieldPair, 'custom_fields');
            }
        }
        
        return $result['success'];
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