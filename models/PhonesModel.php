<?php

class PhonesModel extends BaseMaodel {
    
    public function getAll() {
        $statement = self::$db->query("SELECT * FROM phones WHERE user_id = ");
    }    
}