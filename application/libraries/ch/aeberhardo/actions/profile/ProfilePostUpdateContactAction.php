<?php

namespace ch\aeberhardo\actions\profile;

use \Laravel\Input;
use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Redirect;
use \ch\aeberhardo\validators\ValidationException;

class ProfilePostUpdateContactAction {

    /**
     * @var \ch\aeberhardo\dao\UserDAO
     */
    private $userDAO;

    /**
     * @return View
     */
    public function execute() {
        try {
            $user = Auth::user();

            $email = Input::get('email');

            $user->email = $email;

            $this->userDAO->save($user);

            return Redirect::back()->with('alert_success', $this->createAlertSuccess());
        } catch (ValidationException $e) {
            return Redirect::back()->with_input()->with_errors($e->getValidationMessages());
        }
    }

    private function createAlertSuccess() {
        $message = '<b>Contact Data</b> has been updated successfully.';
        return $message;
    }

    public function setUserDAO($userDAO) {
        $this->userDAO = $userDAO;
    }

}
