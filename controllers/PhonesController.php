<?php

class PhonesController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class());
        $this->db = new PhonesModel();
        $this->viewFolder = $viewFolder;
    }
    
    public function index() {
        
        $this->db->getAll();
        $this->renderView($this->viewFolder);
    }
    
    public function create() {
        
    }
}
