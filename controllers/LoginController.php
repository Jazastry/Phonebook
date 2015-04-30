<?php
namespace Controllers;

class LoginController extends BaseController {
    
    function index() {
        if (! empty($_POST)) {
            var_dump($_POST);
        }        
    }
    
    public function loguot() {
        
    }
}