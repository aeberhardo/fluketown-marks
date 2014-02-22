<?php

namespace ch\aeberhardo\actions\auth;

use \Laravel\Auth;
use \Laravel\Input;
use \Laravel\View;
use \Laravel\Redirect;
use \Laravel\Messages;

class AuthPostLoginAction {

    /**
     * @return View
     */
    public function execute() {

        $authData = array();
        $authData['username'] = Input::get('username');
        $authData['password'] = Input::get('password');
        $authData['remember'] = Input::get('remember');

        if (Auth::attempt($authData)) {

            return Redirect::to($this->getSuccessUrl());
        } else {

            $errorMessages = new Messages();
            $errorMessages->add('login', 'Incorrect username and/or password.');

            return Redirect::back()->with_input()->with_errors($errorMessages);
        }
    }

    private function getSuccessUrl() {
        return Input::get('onSuccess');
    }

}
