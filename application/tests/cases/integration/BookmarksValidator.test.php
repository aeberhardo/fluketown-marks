<?php

use \testlib\IntegrationTest;
use \Bookmark;
use \ch\aeberhardo\dao\impl\BookmarkDAOImpl;
use \ch\aeberhardo\validators\bookmarks\BookmarksValidator;

class BookmarksValidatorTest extends IntegrationTest {

    /**
     * @var BookmarkDAOImpl
     */
    private $dao;

    protected function setUp() {
        parent::setUp();

        $this->dao = new BookmarkDAOImpl();
    }

    public function test_valid_bookmark() {
        $bookmark = new Bookmark();

        $bookmark->url = 'http://www.example.com';
        $bookmark->title = 'Example';

        BookmarksValidator::validate($bookmark);

        // Wenn Validierung erfolgreich, wird folgende Assertion ausgeführt.
        // Wenn Validierung nicht erfolgreich ist, wird vorher eine Exception geworfen.
        $this->assertTrue(true);
    }

    /**
     * @expectedException \ch\aeberhardo\validators\ValidationException
     */
    public function test_duplicate_url_for_one_user() {
        $userId = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('bookmarks')->insert(array('user_id' => $userId, 'url' => 'http://www.example.com', 'title' => 'Example', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        $bookmark = new Bookmark();
        $bookmark->user_id = $userId;
        $bookmark->url = 'http://www.example.com';
        $bookmark->title = 'Example 2';

        BookmarksValidator::validate($bookmark);
    }

    public function test_two_users_have_same_url() {
        $userId = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('bookmarks')->insert(array('user_id' => $userId, 'url' => 'http://www.example.com', 'title' => 'Example', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        $bookmark = new Bookmark();
        $bookmark->user_id = $userId + 999;
        $bookmark->url = 'http://www.example.com';
        $bookmark->title = 'Example 2';

        BookmarksValidator::validate($bookmark);

        // Wenn Validierung erfolgreich, wird folgende Assertion ausgeführt.
        // Wenn Validierung nicht erfolgreich ist, wird vorher eine Exception geworfen.
        $this->assertTrue(true);
    }

    public function test_edit_existing_bookmark_for_one_user() {
        $userId = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        $bookmarkId = DB::table('bookmarks')->insert_get_id(array('user_id' => $userId, 'url' => 'http://www.example.com', 'title' => 'Example', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));


        $bookmark = $this->dao->findById($bookmarkId);
        $bookmark->title = 'Example 2';

        BookmarksValidator::validate($bookmark);

        // Wenn Validierung erfolgreich, wird folgende Assertion ausgeführt.
        // Wenn Validierung nicht erfolgreich ist, wird vorher eine Exception geworfen.
        $this->assertTrue(true);        
    }

}
