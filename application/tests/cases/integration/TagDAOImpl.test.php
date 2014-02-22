<?php

use \testlib\IntegrationTest;
use \ch\aeberhardo\dao\impl\TagDAOImpl;

class TagDAOImplTest extends IntegrationTest {

    /**
     * @var TagDAOImpl
     */
    private $dao;

    protected function setUp() {
        parent::setUp();

        $this->dao = new TagDAOImpl();
    }

    public function test_findByBookmark() {
        
        $userID = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        $bookmarkID1 = DB::table('bookmarks')->insert_get_id(array('user_id' => $userID, 'url' => 'url 1', 'title' => 'title 1', 'description' => 'description 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        $bookmarkID2 = DB::table('bookmarks')->insert_get_id(array('user_id' => $userID, 'url' => 'url 2', 'title' => 'title 2', 'description' => 'description 2', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        
        DB::table('tags')->insert(array('bookmark_id' => $bookmarkID1, 'name' => 'tag 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('tags')->insert(array('bookmark_id' => $bookmarkID2, 'name' => 'tag x', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('tags')->insert(array('bookmark_id' => $bookmarkID1, 'name' => 'tag 2', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('tags')->insert(array('bookmark_id' => $bookmarkID1, 'name' => 'tag 3', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        $bookmark = new Bookmark();
        $bookmark->id = $bookmarkID1;

        $tags = $this->dao->findByBookmark($bookmark);

        $this->assertCount(3, $tags);
    }

}
