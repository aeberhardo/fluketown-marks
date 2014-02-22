<?php

class Auth_Controller extends Base_Controller {

    public $restful = true;

    public function __construct() {
        $this->filter('before','loginAccess')->except(array('logout'));
    }
    
    function get_login() {
        $action = IoC::resolve('authGetLoginAction');
        return $action->execute();
    }
    
    function get_popup() {
        $action = IoC::resolve('authGetPopupAction');
        return $action->execute();
    }
    
    function post_login() {
        $action = IoC::resolve('authPostLoginAction');
        return $action->execute();
    }
    
    function get_logout() {
        $action = IoC::resolve('authGetLogoutAction');
        return $action->execute();
    }
    
    function get_signup() {
        $action = IoC::resolve('authGetSignupAction');
        return $action->execute();
    }

    function post_signup() {
        $action = IoC::resolve('authPostSignupAction');
        return $action->execute();
    }

}