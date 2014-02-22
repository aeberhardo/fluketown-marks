<?php

use \testlib\IntegrationTest;
use \ch\aeberhardo\dao\impl\BookmarkDAOImpl;

class BookmarkDAOImplTest extends IntegrationTest {

    /**
     * @var BookmarkDAOImpl
     */
    private $dao;

    protected function setUp() {
        parent::setUp();

        $this->dao = new BookmarkDAOImpl();
    }

    public function test_findById() {
        $userID = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        $bookmarkID = DB::table('bookmarks')->insert_get_id(array('user_id' => $userID, 'url' => 'url 1', 'title' => 'title 1', 'description' => 'description 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        $bookmark = $this->dao->findById($bookmarkID);

        $this->assertEquals($bookmarkID, $bookmark->id);
        $this->assertEquals($userID, $bookmark->user_id);
        $this->assertEquals('url 1', $bookmark->url);
        $this->assertEquals('title 1', $bookmark->title);
        $this->assertEquals('description 1', $bookmark->description);
    }

    public function test_findById_on_empty_datasource() {
        $bookmark = $this->dao->findById(999);
        $this->assertNull($bookmark);
    }

    public function test_findByUserIdAndUrl() {
        $userId = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        $bookmarkId = DB::table('bookmarks')->insert_get_id(array('user_id' => $userId, 'url' => 'url 1', 'title' => 'title 1', 'description' => 'description 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('bookmarks')->insert(array('user_id' => $userId, 'url' => 'url 2', 'title' => 'title 2', 'description' => 'description 2', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        $bookmark = $this->dao->findByUserIdAndUrl($userId, 'url 1');

        $this->assertEquals($bookmarkId, $bookmark->id);
    }

}
