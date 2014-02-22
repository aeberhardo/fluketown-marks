<?php

class Window_Controller extends Base_Controller {

    public $restful = true;

    function get_close() {
        return View::make('window.close');
    }

}