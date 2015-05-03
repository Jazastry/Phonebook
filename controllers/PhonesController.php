<?php

class PhonesController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class(), $viewFolder);
        $this->model = new PhonesModel();
        $this->title = 'Phones';
        
        $auth = Auth::get_instance();
        $this->user = $auth->get_logged_user();
        
        if ( empty( $this->user )) {
            die( 'No access allowed here. You have to login first.' );
        }
    }
    
    public function index() {
        $phones = $this->model->getAll();
        if (isset($phones)) {
            $this->phones = $phones;
            $this->renderView();
        }        
    }
    
    public function create() {
        if ($this->isPost) {
            $element = $this->validate->form($_POST);
            $element['user_id'] = $this->user['id'];
            $isCreated = $this->model->addNew($element);
            
            if ($isCreated) {
                $this->redirect('phones');
            }
        }
        
        $this->renderView(__FUNCTION__);
    }
}
