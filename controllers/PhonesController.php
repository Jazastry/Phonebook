<?php

class PhonesController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class());
        $this->db = new PhonesModel();
        $this->title = 'Phones';
        $this->viewFolder = $viewFolder;
    }
    
    public function index() {
        $phones = $this->db->getAll();
        if (isset($phones)) {
            $this->phones = $phones;
            $this->renderView($this->viewFolder);
        }      
        
    }
    
    public function create() {
        if ($this->isPost) {
            foreach ($_POST as $key => $value) {
                echo $key . ' ' . $value;
            }
        }
        
        $this->renderView($this->viewFolder, __FUNCTION__);
    }
}
