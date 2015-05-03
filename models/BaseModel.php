<?php

abstract class BaseModel {
    
    protected static $db;
    
    public function __construct() {
        if (self::$db == null) {
            self::$db = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$db->set_charset('utf8');
            
            if (self::$db->connect_errno) {
                die('Can not connect to the database.');
            }
        }
        $this->check = new Check();
    }
    
    public function processResults($result_set){
        $results = array();
        
        if (! empty($result_set) && $result_set->num_rows > 0) {
            while ($row = $result_set->fetch_assoc()) {
                $results[] = $row;
            }
        }
        
        return $results;
    }
    
    public function add ( $element ) {
        $keys = array_keys ($element);
        $values = array();
        
        foreach ( $element as $key => $value ) {
            $values[] = "'" . self::$db->real_escape_string($value) . "'";
        }
        
        $keys = implode($keys, ',');
        $values = implode( $values, ',');
        
        $query = " INSERT INTO {$this->table}($keys) VALUES($values)";
        
        self::$db->query($query);
        
        if (self::$db->affected_rows > 0) {
            return true;
        }
        return false;
    }
}
