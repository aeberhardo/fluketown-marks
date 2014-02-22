<?php

namespace ch\aeberhardo\actions\auth;

use \Laravel\Input;
use \Laravel\View;
use \Laravel\Redirect;
use \Laravel\Hash;
use \User;
use \ch\aeberhardo\validators\ValidationException;
use \ch\aeberhardo\validators\forms\SignupFormValidator;

class AuthPostSignupAction {

    /**
     * @var \ch\aeberhardo\dao\UserDAO
     */
    private $userDAO;

    /**
     * @return View
     */
    public function execute() {

        try {

            $this->validateInput();

            $user = $this->createUserFromInput();
            $this->persist($user);

            // Wenn erfolgreich: Redirect direkt zu auth@login.
            // Dabei werden Daten in die Session geflashed und es muss aufgepasst werden, dass diese
            // nicht durch einen Filter verloren gehen (würde passieren, wenn "Redirect::home()" verwendet würde).
            return Redirect::to_action('auth@login')->with('alert_success', $this->createAlertSuccess($user));
            
        } catch (ValidationException $e) {
            return Redirect::back()->with_input()->with_errors($e->getValidationMessages());
        }
    }

    /**
     * @param User $user
     * @return string
     */
    private function createAlertSuccess(User $user) {
        $message = 'The account for <b>' . e($user->username) . '</b> (' . e($user->email) . ') has been created successfully. Please log in now.';
        return $message;
    }

    private function validateInput() {
        SignupFormValidator::validate(Input::get());
    }

    /**
     * @param User $user
     */
    private function persist(User $user) {
        $this->userDAO->save($user);
    }

    /**
     * @return User
     */
    private function createUserFromInput() {
        $username = Input::get('username');
        $email = Input::get('email');
        $password = Input::get('password');

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = Hash::make($password);

        return $user;
    }

    public function setUserDAO($userDAO) {
        $this->userDAO = $userDAO;
    }

}
