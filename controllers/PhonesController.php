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
        $this->phones = $phones;        
        if (count($phones) == 0) {
            $this->addInfoMessage('You don`t have phone records. Go to Create Record if you want to add one.');
        }
        $this->renderView();
    }
    
    public function create() { 
        if ($this->isPost) {
                        
            $paramsValidated = $this->validate->form($_POST);
            $hasNoErrors = $this->messages->hasNoErrors($paramsValidated);
            $isCreated = false;
            
            if ($hasNoErrors) {
                $paramsValidated['user_id'] = $this->user['id'];       
                $isCreated = $this->model->addNew($paramsValidated);
            }
            
            
            if ($isCreated && $hasNoErrors) {
                $this->messages->addInfoMessage('Reccord created.');
                $this->redirect();
            }
            if (! $isCreated || ! $hasNoErrors) {                
                $this->messages->addErrorMessage('Reccord was not created.');
                $this->messages->extractErrors( $paramsValidated );
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
    
    public function delete( $id ) { 
        $phoneId = intval( $id[0] );
        
        $phone = $this->model->get($phoneId);
        
        $isDeleted = $this->model->delete( $phoneId );
        
        if ($isDeleted) {
            $this->messages->addInfoMessage('Phone ' . $phone['name'] . ' deleted.');
            $this->redirect();
        }
        if (! $isDeleted) {
            $this->addErrorMessage('Phone was not deleted.');
        }
        
        $this->renderView();
    }
}
