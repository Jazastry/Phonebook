<?php

abstract class BaseModel {

    protected $db;
    
    public function __construct() {
        
        $db_object = Database::get_instance();        
        $this->db = $db_object::get_db();
        $this->validate = new Validate();
        $this->limit = 0;
    }
    
    public function processResults($result_set){
        $results = array();
        
        if (! empty($result_set) && $result_set->num_rows > 0) {
            while ($row = $result_set->fetch_assoc()) {
                $rowDecoded = $this->validate->dataOutputValidate($row);
                $results[] = $rowDecoded;
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
    
    public function find( $table, $limit, $where, $columns){
        
        $query = "SELECT {$columns} FROM {$table}";
        
        if (! empty($where)) {
            $query .= " WHERE $where";
        }
        
        if (! empty($limit)) {
            $query .= " LIMIT $limit";
        }
        
        $result_set = self::$db->query($query);
        
        $results = $this->process_results($result_set);
        
        return $results;
    }
}
