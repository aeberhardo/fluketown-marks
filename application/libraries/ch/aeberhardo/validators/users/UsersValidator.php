<?php

namespace ch\aeberhardo\validators\users;

use Laravel\Validator;
use \User;
use \ch\aeberhardo\validators\ValidationException;

class UsersValidator {

    private function __construct() {
        
    }

    /**
     * @param User $user
     * @throws ValidationException
     */
    public static function validate(User $user) {

        $validator = static::validator($user);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors);
        }
    }

    /**
     * @param User $user
     * @return Validator
     */
    private static function validator(User $user) {

        $rules = array(
            'username' => 'required|alpha_dash|max:32',
            'email' => 'required|email|max:200',
            'password' => 'required|max:200',
        );

        $validator = Validator::make($user->to_array(), $rules);
        return $validator;
    }

}