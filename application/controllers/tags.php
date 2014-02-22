<?php

class Tags_Controller extends Base_Controller {

    public $restful = true;

    public function __construct() {
        $this->filter('before', 'auth');
    }

    function get_index() {
        $action = IoC::resolve('tagsGetIndexAction');
        return $action->execute();
    }

}