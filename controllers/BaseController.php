<?php
namespace Controllers;

class BaseController {
    
    protected $layout;
    protected $model;
    protected $views_dir;
    
    function index() {
        echo 'BaseController.';
    }    
}

