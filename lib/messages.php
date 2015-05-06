<?php

class Messages {
    
    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        }
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }
    
    function hasNoErrors( $args ) {
        foreach ($args as $key => $value) {
            if (is_array($value)) {
                return false;
            }
        }
        return true;
    }
    
    function extractErrors( $args ) {
        foreach ($args as $key => $value) {
            if (is_array($value)) {
                $errorMessage = $value['errorMessage'];
                $this->addErrorMessage($errorMessage);
            }
        }
    }
}