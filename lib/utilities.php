<?php

class Utilities {
    
    public function addCheckToGroups( $phoneGroups, $groups ) {
        
        $result = array();
        
        foreach ( $groups as $group ) {
            $transGroup = $group;
            
            foreach ( $phoneGroups as $phoneGroup ) {
                
                if ( $group['id'] == $phoneGroup['id'] ) {
                    $transGroup['checked'] = true;
                    break;
                }
            }
            
            array_push( $result, $transGroup );
        }
        
        return $result;
    }
    
    public function extractPairs( $args ) {
        
        $result = array();
        
        while ( count( $args ) > 0 ) {
            $couple = array_slice( $args, 0, 2 ); 
            $args = array_slice( $args, 2, count( $args ) );
            array_push( $result, $couple );
        }        
        
        return $result;
    }
    
    public function fieldsRemove( $args ) {
        $result = array();
        foreach ($args as $key => $value) {
            if (! $this->startsWith($key, 'field')) {                
                $result[$key] = $args[$key];
            }
        }
        
        return $result;
    }
    
    public function extractCustomFields( $args ) {
        $result = array();
        foreach ($args as $key => $value) {
            if ($this->startsWith($key, 'field')) {                
                $result[$key] = $args[$key];
            }
        }
        
        return $result;
    }
    
    public function fieldsKeysCleanup( $args ) {
        $result = array();
        foreach ($args as $fieldPair) {
            $trans = array();
            foreach ($fieldPair as $key => $value) {
                if ($this->startsWith($key, 'field')) {                
                    $trans[preg_replace('/[0-9]+/', '', $key)] = $fieldPair[$key];
                } else {
                    $trans[$key] = $fieldPair[$key];
                }                
            }
            array_push($result, $trans);
        }
        
        return $result;
    }
    
    function startsWith($string, $needle) {
        return $needle === "" ||
                strrpos($string, $needle, -strlen($string)) !== FALSE;
    }
}

