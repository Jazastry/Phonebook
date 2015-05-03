<?php

class Auth {
    private static $is_logged_in = false;
    private static $logged_user = array();
    
    private function __construct() {
        session_set_cookie_params( 5800, "/");
        session_start();
        
        if (! empty( $_SESSION['username'])) {
            self::$is_logged_in = true;
            self::$logged_user = array(
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username']
            );
        }
    }
    
    public function get_logged_user() {
        return self::$logged_user;
    }
    
    public function is_logged_in() {
        return self::$is_logged_in;
    }
    
    public function login( $username, $password ) {
        $db_obj = Database::get_instance();
        $db = $db_obj->get_db();
        $statement = $db->prepare(
            "SELECT id, username FROM users WHERE username = ? " 
                . "AND password =  ? LIMIT 1"
        );        
        
        $statement->bind_param("ss", $username, $password);
        
        $statement->execute();
        
        $result_set = $statement->get_result();
        $row = $result_set->fetch_assoc();
        if (! empty($row)) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];
            
            return true;
        }
        
        return false;
    }
    
    public function userExists ( $username ) {
        $db_obj = Database::get_instance();
        $db = $db_obj->get_db();
        $statement = $db->prepare("SELECT * FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();
       
        if (count($result) > 0) {
            return true;            
        }
        return false; 
    }
    
    public static function get_instance() {
        static $instance = null;
        
        if (null === $instance) {
            $instance = new static();
        }
        
        return $instance;
    }
}