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
        $this->currentActionBar = 'views/logged/partials/groups/indexActionBar.php';
        
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
        $this->currentActionBar = 'views/logged/partials/groups/viewActionBar.php';
        
        if ( empty( $this->phones ) ) {
            $this->messages->addInfoMessage('You don`t have any phones in this group.'
                    . ' Go to Manage groups if you want to add one.');
        }        
        
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

        $this->currentActionBar = 'views/logged/partials/groups/createActionBar.php';
        $this->renderView( __FUNCTION__ );
    }
    
    public function delete( $id ) { 
        $groupId = intval( $id[0] );
        
        $isDeleted = $this->model->deleteById( $groupId );
        
        if ($isDeleted) {
            $this->messages->addInfoMessage( 'Group deleted.' );
            $this->redirect();
        }
        if (! $isDeleted) {
            $this->messages->addErrorMessage( 'Group was not deleted.' );
        }
        
        $this->renderView();
    }
    
    public function addPhone( $phoneIdIn ) {        
        $phoneId = '';
        if ($this->isPost) {
            $phoneId = htmlspecialchars($_POST['phone_id']);            
            $paramsValidated = $this->validate->form($_POST);
            $hasNoErrors = $this->messages->hasNoErrors($paramsValidated);
            $isCreated = false;
            
            if ($hasNoErrors) {                       
                $isCreated = $this->model->addPhoneToGroups($paramsValidated, $phoneId);
            }
            
            if ($isCreated && $hasNoErrors) {
                $this->messages->addInfoMessage('Phone groups updated.');
            }
            if (! $hasNoErrors) {                
                $this->messages->addErrorMessage('Phone groups was not updated.');
                $this->messages->extractErrors( $paramsValidated );
            }
        }
        
        if (! empty($phoneIdIn[0])) {
            $phoneId = htmlspecialchars( $phoneIdIn[0] );
        }
        
        $utils = new Utilities();
        
        $this->phone = $this->model->getPhone( intval($phoneId) );
        $userId = $this->user['id'];        
        
        $this->groups = $this->model->getAllGroups( $userId );
        $this->phoneGroups = $this->model->getPhoneGroups( $this->phone['id'] );
        $groups = $utils->addCheckToGroups( $this->phoneGroups, $this->groups );
        $this->groups = $groups;
        
        $this->title = 'Add phone to ' . $this->title;
        
        if (empty($this->groups)) {
            $this->messages->addInfoMessage( 'You don`t have any groups currently.' );
        }
        
        $this->currentActionBar = 'views/logged/partials/groups/addPhoneActionBar.php';
        $this->renderView( __FUNCTION__ );
    }
}
