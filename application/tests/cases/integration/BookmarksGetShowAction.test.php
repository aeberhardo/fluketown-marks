<?php

use \testlib\IntegrationTest;

class BookmarksGetShowActionTest extends IntegrationTest {

    /**
     * @var \ch\aeberhardo\actions\bookmarks\BookmarksGetShowAction
     */
    private $action;

    protected function setUp() {
        parent::setUp();

        $this->action = IoC::resolve('bookmarksGetShowAction');
    }

    public function test_bookmark_found() {
        $userID = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        $bookmarkID = DB::table('bookmarks')->insert_get_id(array('user_id' => $userID, 'url' => 'url 1', 'title' => 'title 1', 'description' => 'description 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        $view = $this->action->execute($bookmarkID);

        $this->assertInstanceOf('View', $view);

        $bookmark = $view->data()['bookmark'];

        $this->assertInstanceOf('Bookmark', $bookmark);

        $this->assertEquals($bookmarkID, $bookmark->id);
        $this->assertEquals('url 1', $bookmark->url);
    }

    public function test_bookmark_not_found() {
        $response = $this->action->execute(999);

        $this->assertInstanceOf('Response', $response);
        $this->assertEquals(404, $response->status());
    }

}
