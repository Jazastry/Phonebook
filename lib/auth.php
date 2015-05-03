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
}