<?php

class About_Controller extends Base_Controller {

    public $restful = true;

    function get_index() {
        $action = IoC::resolve('aboutGetIndexAction');
        return $action->execute();
    }

}