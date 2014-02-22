<?php

class Bookmarklet_Controller extends Base_Controller {

    public $restful = true;

    function get_index() {
        $action = IoC::resolve('bookmarkletGetIndexAction');
        return $action->execute();
    }

}