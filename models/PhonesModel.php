<?php

class PhonesModel extends BaseModel {
    
    public function getAll() {
        $statement = self::$db->prepare("SELECT * FROM phones WHERE user_id = ?;");
        $userId = 1;
        $statement->bind_param('i', $userId);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
        
        var_dump($result);
    }    
}