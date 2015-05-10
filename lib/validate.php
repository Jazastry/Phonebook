<?php

class Validate {
    
    public function urlValidate( $params ) {
        $match = preg_replace('/[^A-Za-z0-9\/]/', '', $params);        
        return $match;
    }
    
    public function form( $params ) {
        $utils = new Utilities();
        $result = array();
        foreach ($params as $key => $value) {
            
            if ($key == 'number') {
                $value = $this->cleanWhitespaces($value);
                $value = 
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
                $result[$key] = $this->executeValidation($value, $key, 'Name');              
            }
            
            if ( $key == 'password' ) {
                $value = $this->cleanWhitespaces($value);
                $result[$key] = $this->executeValidation($value, $key, 'Password '
                        . 'Only words, numbers, under-score, dot and dash are permited.');
            }
            
            if ( $key == 'username' ) {
                $value = $this->cleanWhitespaces($value);
                $result[$key] = $this->executeValidation($value, $key, 'Username. '
                        . 'Only words, numbers, under-score, dot and dash are permited');
            }
            
            if ($utils->startsWith($key, 'field')) {
                $result[$key] = $this->executeValidation($value, 'field', 'custom field');
            }
            
            if ($utils->startsWith($key, 'group')) {
                $result[$key] = $this->executeValidation($value, 'group', 'group selection');
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
    
    public function dataInputValidate( $params ) {
        $result = array();
        foreach ($params as $key => $value) {
            $
            $result[$key] = htmlspecialchars($value);
        }        
        return $result;
    }
    
    private function executeValidation($valIn, $func, $message) {
        $isValid = self::{$func}($valIn);
        if($isValid) {
            return htmlspecialchars($valIn);
        } else {
            return array('errorMessage' => "Invalid {$message}.");
        }
    }
    
    public static function email($val) {
        if (! empty($val)) {
            return filter_var($val, FILTER_VALIDATE_EMAIL) !== false;
        }
        return true;
    }
    
    public static function number($val) {
        if (! empty($val)) {
            if (strlen($val) < 3) {
                return false;
            }
            return (bool)preg_match("/^([+\-]?[0-9]*[\- ]*([(]{1}[0-9]*[)]{1})*[\- ]?([0-9]+[\- ]?[0-9]+)*)$/", $val);
        }
        
        return true;
    }
    
    public static function name($val) {
        if (strlen($val) < DEFAULT_MIN_LENGTH) {
            return false;
        }
        return true;
    }
    
    public static function username($val) {
        if (strlen($val) < DEFAULT_MIN_LENGTH) {
            return false;
        }
        
        return !(bool)preg_match('/[^a-zA-Z0-9-_.]+/', $val);
    }
    
    public static function address($val) {
        if (! empty($val)) {
            if (strlen($val) > 100 || strlen($val) < DEFAULT_MIN_LENGTH) {
                return false;
            }
        }
        return true;
    }
    
    public static function password($val) {
        if (strlen($val) > 50 || strlen($val) < DEFAULT_MIN_LENGTH) {
            return false;
        }
        return (bool)preg_match('/^(([a-zA-Z0-9]+[.\-_*]*)*[a-zA-Z0-9]*)+$/', $val);
    }
    
    public static function field($val) {
        if (strlen($val) > 100 || strlen($val) < DEFAULT_MIN_LENGTH) {
            return false;
        }      
        return true;
    }
    
    public static function group($val) {
        if (strlen($val) > 100 || strlen($val) < DEFAULT_MIN_LENGTH) {
            return false;
        }      
        return true;
    }

    public static function cleanWhitespaces($val) {
        return preg_replace('/[ ]+/', '', $val);
    }
}