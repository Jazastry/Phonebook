<?php

class GroupsController extends BaseController {
    
    public function __construct( $viewFolder ) {
        parent::__construct( get_class(), $viewFolder );
        $this->model = new GroupsModel();
        $this->title = 'Groups';
        
        $auth = Auth::get_instance();
        $this->user = $auth->get_logged_user();
        
        if ( empty( $this->user )) {
            $this->messages->addErrorMessage( 'No access allowed here.'
                    . ' You have to login first.' );
            $this->redirect( 'account', 'login' );
        }
    }
    
    public function index() {
        
        $userId = $this->user['id'];
        $groups = $this->model->getAllGroups( $userId ); 
        $this->groups = $groups;
        
        if ( count( $groups ) == 0 ) {
            $this->messages->addInfoMessage( 
                    'You don`t have any groups.'
                    . ' Go to Add Group if you want to add one.');
        }
        
        $this->renderView();
    }
    
    public function view ( $id ) {
        
        $groupId = $id[0];
        $this->group = $this->model->get( $groupId );
        $this->phones = $this->model->getPhonesByGroupId( $groupId );
        
        $this->renderView( __FUNCTION__ );
    }
    
    public function create() { 
        if ( $this->isPost ) {
            
            $paramsValidated = $this->validate->form( $_POST );
            $hasNoErrors = $this->messages->hasNoErrors( $paramsValidated );
            $isCreated = false;
            
            if ( $hasNoErrors ) {
                
                $paramsValidated['user_id'] = $this->user['id'];            
                $isCreated = $this->model->addNew( $paramsValidated );
            }
            
            if ( $isCreated && $hasNoErrors ) {
                
                $this->messages->addInfoMessage( 'Group created.' );
                $this->redirect();
            }
            if ( ! $isCreated || ! $hasNoErrors ) {
                $this->messages->addErrorMessage( 'Group was not created.' );
                $this->messages->extractErrors( $paramsValidated );
            }
        }

        $this->renderView( __FUNCTION__ );
    }
    
    public function delete( $id ) { 
        $groupId = intval( $id[0] );
        
        $isDeleted = $this->model->delete( $groupId );
        
        if ($isDeleted) {
            $this->messages->addInfoMessage( 'Group deleted.' );
            $this->redirect();
        }
        if (! $isDeleted) {
            $this->messages->addErrorMessage( 'Group was not deleted.' );
        }
        
        $this->renderView();
    }
}
