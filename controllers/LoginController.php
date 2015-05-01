<?php

class LoginController extends BaseController {
    
    function index() {
        if (! empty($_POST)) {
            var_dump($_POST);
        }
        $this->renderView();
    }
    
    public function loguot() {
        
    }
}