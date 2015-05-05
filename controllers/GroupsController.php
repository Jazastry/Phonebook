<?php

class GroupsController extends BaseController {
    
    public function __construct($viewFolder) {
        parent::__construct(get_class(), $viewFolder);
        $this->model = new GroupsModel();
        $this->title = 'Groups';
        
        $auth = Auth::get_instance();
        $this->user = $auth->get_logged_user();
        
        if ( empty( $this->user )) {
            $this->addErrorMessage('No access allowed here. You have to login first.');
            $this->redirect('account', 'login');
        }
    }
    
    public function index() {
        $userId = $this->user['id'];
        $groups = $this->model->getAllGroups($userId); 
        $this->groups = $groups;        
        if (count($groups) == 0) {
            $this->addInfoMessage('You don`t have any groups. Go to Create Group if you want to add one.');
        }
        $this->renderView();
    }
    
    public function view ( $id ) {
        $groupId = $id[0];
        $this->group = $this->model->get($groupId);
        $this->phones = $this->model->getPhonesByGroupId( $groupId );
        
        $this->renderView(__FUNCTION__);
    }
    
}
