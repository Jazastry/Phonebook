<?php

class Validate {
    
    public function urlValidate( $params ) {
        $match = preg_replace('/[^A-Za-z0-9\/]/', '', $params);        
        return $match;
    }
    
    public function form( $params ) {
        $result = array();
        foreach ($params as $key => $value) {
            
            if ($key == 'number') {
                $value = $this->cleanWhitespaces($value);
                $result[$key] = $this->executeValidation($value, $key, 'Phone Number');
            } 
           
            if ( $key == 'email' ) {
                $value = $this->cleanWhitespaces($value);
                $result[$key] = $this->executeValidation($value, $key, 'Email');
            }
            
            if ( $key == 'address' ) {
                $result[$key] = $this->executeValidation($value, $key, 'Address');              
            }
            
            if ( $key == 'name' ) {
                $result[$key] = $this->executeValidation($value, $key, 'Address');              
            }
            
            if ( $key == 'password' ) {
                $value = $this->cleanWhitespaces($value);
                $result[$key] = $this->executeValidation($value, $key, 'Password');
            }
            
            if ( $key == 'username' ) {
                $value = $this->cleanWhitespaces($value);
                $result[$key] = $this->executeValidation($value, $key, 'Username');
            }
            
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
    
    private function executeValidation($valIn, $func, $message) {
        $isValid = self::{$func}($valIn);
        if($isValid) {
            return htmlentities($valIn);
        } else {
            die("Invalid {$message}.");
        }
    }
    
    public static function email($val) {
        return filter_var($val, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public static function number($val) {
        if (strlen($val) < 3) {
            return false;
        }
        return (bool)preg_match("/^([+\-]?[0-9]*[\- ]*([(]{1}[0-9]*[)]{1})*[\- ]?([0-9]+[\- ]?[0-9]+)*)$/", $val);
    }
    
    public static function name($val) {
        if (strlen($val) < 1) {
            return false;
        }
        return true;
    }
    
    public static function username($val) {
        if (strlen($val) < 1) {
            return false;
        }
        return true;
    }
    
    public static function address($val) {
        if (strlen($val) > 100 || strlen($val) < 1) {
            return false;
        }
        return true;
    }
    
    public static function password($val) {
        if (strlen($val) > 50 || strlen($val) < 1) {
            return false;
        }
        return (bool)preg_match('/^(([a-zA-Z0-9]+[.\-_*]*)*[a-zA-Z0-9]*)+$/', $val);
    }

    public static function cleanWhitespaces($val) {
        return preg_replace('/[ ]+/', '', $val);
    }
}