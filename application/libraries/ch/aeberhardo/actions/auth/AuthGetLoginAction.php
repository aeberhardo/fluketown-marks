<?php

namespace ch\aeberhardo\actions\auth;

use \Laravel\Input;
use \Laravel\View;
use \Laravel\Session;
use \ch\aeberhardo\url\URLManager;

class AuthGetLoginAction {

    /**
     * @return View
     */
    public function execute() {
        return View::make('auth.login')
                        ->with('username', Input::old('username'))
                        ->with('alert_success', Session::get('alert_success'))
                        ->with('urlManagerForLogin', $this->createURLManagerForLogin());
    }

    private function createURLManagerForLogin() {
        return URLManager::make()->home('onSuccess');
    }

}
