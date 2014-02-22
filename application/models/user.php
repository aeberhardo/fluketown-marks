<?php

use Laravel\Database\Eloquent\Model;
use \ch\aeberhardo\validators\users\UsersValidator;

class User extends Model {

    public function save() {
        $this->validate();
        parent::save();
    }

    public function validate() {
        UsersValidator::validate($this);
    }

}
