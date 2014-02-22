<?php

namespace ch\aeberhardo\actions\auth;

use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Redirect;

class AuthGetLogoutAction {

    /**
     * @return View
     */
    public function execute() {

        Auth::logout();

        return Redirect::home();
    }

}
