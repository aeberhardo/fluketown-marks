<?php

namespace ch\aeberhardo\validators\forms;

use Laravel\Validator;
use \ch\aeberhardo\validators\ValidationException;

class SignupFormValidator {

    private function __construct() {
        
    }

    /**
     * @throws ValidationException
     */
    public static function validate($formData = array()) {

        $validator = static::validator($formData);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors);
        }
    }

    /**
     * Neuen Validator mit Regeln und custom error messages erstellen.
     * Die lesefreundlichen Attribut-Namen sind im
     * Array "attributes" in application/language/en/validation.php zu finden.
     * @return Validator
     */
    private static function validator($formData = array()) {

        $rules = array(
            'username' => 'required|alpha_dash|max:32|unique:users',
            'email' => 'required|email|max:200',
            'password' => 'required|alpha_dash|between:6,16|confirmed',
        );


        $validator = Validator::make($formData, $rules);
        return $validator;
    }

}