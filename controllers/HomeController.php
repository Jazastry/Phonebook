<?php

class HomeController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class());
        $this->title = 'Home';
        $this->viewFolder = $viewFolder;
    }
    
    function index() {
        $this->renderView('home');
    }
}