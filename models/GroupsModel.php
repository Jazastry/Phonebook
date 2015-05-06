<?php

class GroupsModel extends BaseModel {
    
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'groups'));
    }
    
    public function getAllGroups($userId) {
        $args = array(
            'where' => 'user_id = ' . $userId
        );
        $results = $this->find($args);
        
        return $results;
    }
    
    public function addNew( $args ) {
        
        $result = $this->add( $args );
        
        return $result['success'];        
    }
    
    public function getPhonesByGroupId( $groupId ) {
        $args = array(
            'columns' => 'p.id, p.name',
            'table' => 'phones_groups pg '
                    . 'JOIN phones p '
                    . 'ON pg.phone_id = p.id',
            'where' => 'pg.group_id = ' . $groupId
        );
        
        $phones = $this->find( $args );
        
        return $phones;
    }
}

