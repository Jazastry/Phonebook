<?php

class PhonesController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class());
        $this->db = new PhonesModel();
        $this->title = 'Phones';
        $this->viewFolder = $viewFolder;
        
        $auth = Auth::get_instance();
        $logged_user = $auth->get_logged_user();
        
        if ( empty( $logged_user )) {
            die( 'No access allowed here.' );
        }
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
            $element = $this->validate->form($_POST);
            $element['user_id'] = $this->user['user_id'];
            $isCreated = $this->db->add($element);
            if ($isCreated) {
                $this->redirect('phones');
            }
        }
        
        $this->renderView($this->viewFolder, __FUNCTION__);
    }
}
