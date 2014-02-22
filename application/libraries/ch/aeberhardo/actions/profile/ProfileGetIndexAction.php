<?php

namespace ch\aeberhardo\actions\profile;

use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Session;
use \Laravel\Input;

class ProfileGetIndexAction {

    /**
     * @return View
     */
    public function execute() {

        $user = Auth::user();

        if (Input::had('email')) {
            $email = Input::old('email');
        } else {
            $email = $user->email;
        }

        return View::make('profile.index')
                        ->with('username', $user->username)
                        ->with('email', $email)
                        ->with('alert_success', Session::get('alert_success'));
    }

}
