<?php
namespace Logged\Controllers;

class PhonesController extends LoggedController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class(), $viewFolder);
        $this->model = new PhonesModel();
        $this->title = 'Phones';       
        
        if ( empty( $logged_user )) {
            die( 'No access allowed here.' );
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
            $element['user_id'] = $this->user['user_id'];
            $isCreated = $this->model->add($element);
            if ($isCreated) {
                $this->redirect('phones');
            }
        }
        
        $this->renderView(__FUNCTION__);
    }
}
