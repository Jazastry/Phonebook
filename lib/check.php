<?php

class Check {
    
    public function urlCheck( $params ) {
        var_dump($params);
        $match = preg_replace('/[^A-Za-z0-9\/]/', '', $params);
        var_dump($match);
        
        return $match;
    }
    
    public function formCheck( $params ) {
        $result = array();
        foreach ($params as $key => $value) {
            $result[$key] = htmlentities($value);
        }
        
        return $result;
    }
    
    public function dataOutputCheck( $params ) {
        $result = array();
        foreach ($params as $key => $value) {
            $result[$key] = html_entity_decode($value);
        }
        
        return $result;
    }
}