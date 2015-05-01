<?php

class PhonesModel extends BaseModel {
    
    public function getAll() {
        $statement = self::$db->prepare("SELECT * FROM phones WHERE user_id = ?;");
        $userId = 1;
        $statement->bind_param('i', $userId);
        $statement->execute();
        $result_set = $statement->get_result();
        $results = $this->processResults($result_set);
        
        return $results;
    }
    
    public function addNew($params = array()) {
        return $this->addNew($params);
    }
}