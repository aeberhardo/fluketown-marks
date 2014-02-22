<?php

namespace ch\aeberhardo\dao\impl;

use \User;
use \ch\aeberhardo\dao\UserDAO;

class UserDAOImpl implements UserDAO {

    public function findById($id) {
        return User::find($id);
    }

    public function save(User $user) {
        return $user->save();
    }

}