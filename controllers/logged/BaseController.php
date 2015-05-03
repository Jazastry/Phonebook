<?php
namespace Logged;

class BaseLoggedController extends \Controllers\BaseController {
    
    public function __construct( $controllerName = '\Logged\BaseLoggedController',
            $viewFolder = '') {        
        parent::__construct( $controllerName, $viewFolder);
        
        $auth = Auth::get_instance();
        $logged_user = $auth->get_logged_user();
        
        if ( empty( $logged_user )) {
            die( 'No access allowed here.' );
        }
    }
}