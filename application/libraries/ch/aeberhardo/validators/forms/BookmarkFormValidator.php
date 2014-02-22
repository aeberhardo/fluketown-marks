<?php

namespace ch\aeberhardo\validators\forms;

use Laravel\Validator;
use \ch\aeberhardo\validators\ValidationException;

class BookmarkFormValidator {

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
            'url' => 'required|url|max:500',
            'title' => 'required|max:200',
            'description' => 'max:1000',
            'tags' => 'match:/^([ \x2ca-z0-9_-])+$/Di',
            'favorite' => 'numeric|in:0,1',
        );

        $messages = array(
            'tags_match' => ':attribute may only contain letters, numbers, whitespaces, underscores and dashes. Multiple tags can be delimited by commas.',
        );
        
        $validator = Validator::make($formData, $rules, $messages);
        return $validator;
    }

}