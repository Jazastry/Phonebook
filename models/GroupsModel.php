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
    
    public function getPhone ( $phoneId ) {
        $args = array( 
            'table' => 'phones',
            'where' => 'id = ' . $phoneId ,
            'limit' => 1
        );
        
        return $this->find( $args )[0];
    }
    
    public function getPhoneGroups ( $phoneId ) {
        $args = array(
            'columns' => 'g.id, g.name',
            'table' => 'phones_groups pg '
                    . 'JOIN groups g '
                    . 'ON g.id = pg.group_id',
            'where' => 'pg.phone_id = ' . $phoneId
                    . ' GROUP BY g.id, g.name' 
        );
        
        $results = $this->find($args);
        
        return $results;
    }
    
    public function addPhoneToGroups ( $groups, $phoneId) {
        
        $result['success'] = false;
        
        $areUnchecked = $this->uncheckGroups( $phoneId );
        
        foreach ($groups as $key => $value) {
            
            $args = array(
                'phone_id' => $phoneId,
                'group_id' => $value                
            );
            
            $result = $this->add( $args, 'phones_groups');
            
            if ( $result['success'] != true ) {
                break;
            }
        }
        
        return $result['success'];
    }
    
    public function uncheckGroups ( $phoneId ) {
        $args = array(
            'table' => 'phones_groups',
            'where' => 'phone_id = ' . $phoneId 
        );
        
        $result = $this->delete( $args );
        
        return $result;
    }
}

