<?php

namespace testlib\util;

use \Laravel\Session;
use \Laravel\Auth;
use \Laravel\Input;

final class SessionUtil {

    private function __construct() {
        
    }

    public static function start() {
        Session::started() or Session::load();
    }

    public static function logout() {
        Auth::logout();
    }

    public static function flush() {
        Session::flush();
    }
    
    public static function addOldInput($key, $value) {
        Session::flash(Input::old_input, array($key => $value));
    }

}