<?php

namespace ch\aeberhardo\validators\tags;

use Laravel\Validator;
use \Tag;
use \ch\aeberhardo\validators\ValidationException;

class TagsValidator {

    private function __construct() {
        
    }

    /**
     * @param Tag $tag
     * @throws ValidationException
     */
    public static function validate(Tag $tag) {

        $validator = static::validator($tag);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors);
        }
    }

    /**
     * @param Tag $tag
     * @return Validator
     */
    private static function validator(Tag $tag) {

        $rules = array(
            'name' => 'required|max:200|match:/^([ a-z0-9_-])+$/Di'
        );

        $validator = Validator::make($tag->to_array(), $rules);
        return $validator;
    }

}