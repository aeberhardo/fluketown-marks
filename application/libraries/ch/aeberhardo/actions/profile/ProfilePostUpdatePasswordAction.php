<?php

namespace ch\aeberhardo\actions\profile;

use \Laravel\Input;
use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Redirect;
use \Laravel\Hash;

use \User;
use \ch\aeberhardo\validators\ValidationException;
use \ch\aeberhardo\validators\forms\PasswordFormValidator;

class ProfilePostUpdatePasswordAction {

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

            $this->validateInput();
            $this->validateCurrentPasswordMatches($user->id, Input::get('current_password'));

            $this->updateUserPassword($user, Input::get('new_password'));

            return Redirect::back()->with('alert_success', $this->createAlertSuccess());
        } catch (ValidationException $e) {
            return Redirect::back()->with_errors($e->getValidationMessages());
        }
    }

    private function validateInput() {
        PasswordFormValidator::validate(Input::get());
    }
    
    /**
     * @param type $user_id
     * @param type $currentPassword Das Passwort in Klartext, welches geprüft werden soll.
     * @throws ValidationException
     */
    private function validateCurrentPasswordMatches($user_id, $currentPassword) {
        
        $user = $this->userDAO->findById($user_id);
        $persistedPasswordHash = $user->password;
        
        if (!Hash::check($currentPassword, $persistedPasswordHash)) {
            throw new ValidationException('Current password is incorrect.');
        }
    }

    /**
     * @return string
     */
    private function createAlertSuccess() {
        $message = '<b>Password</b> has been changed successfully.';
        return $message;
    }

    /**
     * @param User $user
     * @param string $newPassword Neues Password (Klartext)
     */
    private function updateUserPassword(User $user, $newPassword) {
        $user->password = Hash::make($newPassword);
        $this->userDAO->save($user);
    }

    public function setUserDAO($userDAO) {
        $this->userDAO = $userDAO;
    }

}
