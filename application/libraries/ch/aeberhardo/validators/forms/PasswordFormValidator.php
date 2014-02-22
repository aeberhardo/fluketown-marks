<?php

namespace ch\aeberhardo\validators\forms;

use Laravel\Validator;
use \ch\aeberhardo\validators\ValidationException;

class PasswordFormValidator {

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
            'current_password' => 'required',
            'new_password' => 'required|alpha_dash|between:6,16|confirmed|different:current_password',
        );


        $validator = Validator::make($formData, $rules);
        return $validator;
    }

}