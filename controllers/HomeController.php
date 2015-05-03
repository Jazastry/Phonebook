<?php

class HomeController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class(), $viewFolder);
        $this->title = 'Home';
    }
    
    function index() {
        $this->renderView();
    }
}