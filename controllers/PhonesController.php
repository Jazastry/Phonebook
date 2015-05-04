<?php

class PhonesController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class(), $viewFolder);
        $this->model = new PhonesModel();
        $this->title = 'Phones';
        
        $auth = Auth::get_instance();
        $this->user = $auth->get_logged_user();
        
        if ( empty( $this->user )) {
            $this->addErrorMessage('No access allowed here. You have to login first.');
            $this->redirect('account', 'login');
        }
    }
    
    public function index() {
        $userId = $this->user['id'];
        $phones = $this->model->getAll($userId);
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
                $this->addInfoMessage('Reccord created.');
                $this->redirect('phones');
            }
        }

        $this->renderView(__FUNCTION__);
    }
    
    public function view ( $id ) {
        $phoneId = $id[0];
        $this->phone = $this->model->get($phoneId);
        $this->costumFields = $this->model->customFields( $phoneId );
        
        $this->renderView(__FUNCTION__);
    }
    
    public function update( $id ) {
        echo ' In Update';
    }
    
    public function custom( $action ) {
        if (! empty($_POST['custom'])) {
            $this->phone = array(
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address']
            );
            $this->custom = $_POST['custom'];
                        
            if ($action[0] == 1) {
                $_POST['custom'] += 1;
            }
            if ($action[0] == 2) {
                $_POST['custom'] -= 1;
            }            
        }
        
        $this->renderView('create');
    }
}
