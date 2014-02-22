<?php

namespace ch\aeberhardo\actions\auth;

use Laravel\Input;
use \Laravel\View;

class AuthGetSignupAction {

    /**
     * @return View
     */
    public function execute() {
        return View::make('auth.signup')
                ->with('username', Input::old('username'))
                ->with('email', Input::old('email'));
    }

}
