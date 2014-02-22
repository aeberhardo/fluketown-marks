<?php

use \testlib\IntegrationTest;
use \ch\aeberhardo\dao\impl\UserDAOImpl;

class UserDAOImplTest extends IntegrationTest {

    /**
     * @var UserDAOImpl
     */
    private $dao;

    protected function setUp() {
        parent::setUp();

        $this->dao = new UserDAOImpl();
    }

    public function test_findById() {
        $userID = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        
        $user = $this->dao->findById($userID);
        
        $this->assertEquals('username 1', $user->username);
        $this->assertEquals('email 1', $user->email);
        $this->assertEquals('password 1', $user->password);
        
    }
    
    public function test_findById_on_empty_datasource() {
        $user = $this->dao->findById(999);
        $this->assertNull($user);
    }

}
