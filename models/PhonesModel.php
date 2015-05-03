<?php

class PhonesModel extends BaseModel {
    
    protected $table = 'phones';
    
    
    public function getAll() {
        $statement = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = ?;");
        $userId = 1;
        $statement->bind_param('i', $userId);
        $statement->execute();
        $result_set = $statement->get_result();
        $results = $this->processResults($result_set);
        
        return $results;
    }
    
    public function addNew($element) {
        return $this->add($element);
    }
}