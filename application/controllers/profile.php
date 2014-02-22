<?php

class Profile_Controller extends Base_Controller {

    public $restful = true;

    public function __construct() {
        $this->filter('before', 'auth');
    }

    function get_index() {
        $action = IoC::resolve('profileGetIndexAction');
        return $action->execute();
    }
    
    function post_update_contact() {
        $action = IoC::resolve('profilePostUpdateContactAction');
        return $action->execute();
    }
    
    function post_update_password() {
        $action = IoC::resolve('profilePostUpdatePasswordAction');
        return $action->execute();
    }

}