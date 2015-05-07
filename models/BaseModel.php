<?php

abstract class BaseModel {

    protected $db;
    protected $table;
    protected $limit;
    
    public function __construct($argsIn = array()) {        
        $defaults = array(
            'limit' => 0
        );
        
        $args = array_merge($defaults, $argsIn);
        
        if (! isset($args['table'])) {
            die('Table not defined.');
        }
        
        extract($args);
        
        $this->table = $table;
        $this->limit = $limit;
        
        
        $db_object = Database::get_instance();        
        $this->db = $db_object::get_db();
        $this->validate = new Validate();
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
    
    public function get( $id ){
        return $this->find(array(
            'where' => 'id = ' . $id ,
            'limit' => 1            
        ))[0];
    }
    
    public function add ($element, $tableIn = null) {
        $table = $this->table;
        if ($tableIn !== null) {
            $table = $tableIn;
        }
        
        $keys = array_keys ($element);
        $values = array();
        
        foreach ( $element as $key => $value ) {
            $values[] = "'" . $this->db->real_escape_string($value) . "'";
        }
        
        $keys = implode($keys, ',');
        $values = implode( $values, ',');
        
        $query = " INSERT INTO {$table}($keys) VALUES($values);";
                
        $this->db->query($query);
        $err = $this->db->error;
        $result = array();
        
        if (! empty($this->db->insert_id)) {            
            $result['entryId'] = $this->db->insert_id;
            $result['success'] = true;
            return $result;
        }
        
        return $result['success'] = false;
    }
    
    public function update( $element , $table) {
        
        $query = "UPDATE {$table} SET ";        
        foreach ( $element as $key => $value ) {
            if ( $key === 'id') {
                continue;
            }            
            $query .= "$key = '" . $this->db->real_escape_string($value) . "',";
        }
        
        $query = rtrim($query, ',');
        
        $query .= " WHERE id = {$element['id']}";
        
        $result = $this->db->query( $query );
        $err = $this->db->error;
        
        if ($result) {
            return true;
        }
        return false;
    }
    
    public function find($argsIn = array()){
        $defaults = array(
            'table' => $this->table,
            'limit' => $this->limit,
            'where' => '',
            'columns' => '*'
        );
        
        $args = array_merge($defaults, $argsIn);
        
        extract($args);
        
        $query = "SELECT {$columns} FROM {$table}";
        
        if (! empty($where)) {
            $query .= " WHERE $where";
        }
        
        if (! empty($limit)) {
            $query .= " LIMIT $limit";
        }
        
        $result_set = $this->db->query($query);
        
        $results = $this->processResults($result_set);
        
        return $results;
    }
    
    public function deleteById( $id, $tableIn = null ) {
        $table = $this->table;
        if ($tableIn != null) {
            $table = $tableIn;
        }       
        
        $query = "DELETE FROM " . $table . " WHERE id = ?";
        
        $statement = $this->db->prepare($query);
        $err = $this->db->error;
        $statement->bind_param("i", $id);        
        $statement->execute();        
        
        if ($statement->affected_rows > 0) {
            return true;
        }
        return false;
    }
    
     public function delete($argsIn = array()){
        $defaults = array(
            'table' => '',
            'where' => ''
        );
        
        $args = array_merge($defaults, $argsIn);
        
        extract($args);
        
        $query = "DELETE FROM {$table}";
        
        if (! empty($where)) {
            $query .= " WHERE $where";
        }
        
        $result_set = $this->db->query($query);
        
        if ($result_set) {
            return true;
        }
        return false;
    }
}
