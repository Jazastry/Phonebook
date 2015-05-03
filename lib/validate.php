<?php

class Validate {
    
    public function urlValidate( $params ) {
        $match = preg_replace('/[^A-Za-z0-9\/]/', '', $params);        
        return $match;
    }
    
    public function formValidate( $params ) {
        $result = array();
        foreach ($params as $key => $value) {
            $result[$key] = htmlentities($value);
        }
        
        return $result;
    }
    
    public function dataOutputValidate( $params ) {
        $result = array();
        foreach ($params as $key => $value) {
            $result[$key] = html_entity_decode($value);
        }
        
        return $result;
    }
}