<?php

namespace ch\aeberhardo\dao;

use \User;

interface UserDAO {

    
    /**
     * @return User
     */
    function findById($id);
    
    /**
     * @param User $user
     * @return bool
     */
    function save(User $user);
    
}
