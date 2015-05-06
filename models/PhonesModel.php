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
    
    public function addNew( $element ) {        
        $utils = new Utilities();
        
        $customFields = $utils->extractCustomFields( $element );        
        $paramsCleaned = $utils->fieldsRemove( $element );
        $phoneInsertResult = $this->add( $paramsCleaned );
        
        $result = $phoneInsertResult;
        
        if ($phoneInsertResult['success'] && count( $customFields ) > 0) {

            $pairs =  $utils->extractPairs( $customFields );
            $fieldsReady = $utils->fieldsKeysCleanup( $pairs );
            
            foreach ( $fieldsReady as $fieldPair ) {
                
                $fieldPair['phone_id'] = $phoneInsertResult['entryId'];
                $fieldsInsertResult = $this->add( $fieldPair, 'custom_fields' );
                
                if ( $fieldsInsertResult['success'] != true ) {
                    $result['success'] = false;
                    break;
                }
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
    
    public function getPhoneGroups ( $phoneId ) {
        $args = array(
            'columns' => 'g.name',
            'table' => 'phones_groups pg '
                    . 'JOIN groups g '
                    . 'ON g.id = pg.group_id',
            'where' => 'pg.phone_id = ' . $phoneId
        );
        
        return $this->find( $args );
    }
}