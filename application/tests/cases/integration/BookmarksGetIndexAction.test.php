<?php

use \testlib\IntegrationTest;

class BookmarksGetIndexActionTest extends IntegrationTest {

    /**
     * @var \ch\aeberhardo\actions\bookmarks\BookmarksGetIndexAction
     */
    private $action;

    protected function setUp() {
        parent::setUp();

        $this->action = IoC::resolve('bookmarksGetIndexAction');
    }

    public function test_bookmarks_found() {
        $userID = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('bookmarks')->insert_get_id(array('user_id' => $userID, 'url' => 'url 1', 'title' => 'title 1', 'description' => 'description 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));
        DB::table('bookmarks')->insert_get_id(array('user_id' => $userID, 'url' => 'url 2', 'title' => 'title 2', 'description' => 'description 2', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        Auth::login($userID);

        $view = $this->action->execute();
        $this->assertInstanceOf('View', $view);

        $bookmarksPaginator = $view->data()['bookmarks'];
        $this->assertInstanceOf('Paginator', $bookmarksPaginator);

        $this->assertEquals(2, $bookmarksPaginator->total);
    }

    public function test_bookmarks_not_found() {

        $userID = DB::table('users')->insert_get_id(array('username' => 'username 1', 'email' => 'email 1', 'password' => 'password 1', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')));

        Auth::login($userID);

        $view = $this->action->execute();

        $bookmarksPaginator = $view->data()['bookmarks'];
        $this->assertInstanceOf('Paginator', $bookmarksPaginator);

        $this->assertEquals(0, $bookmarksPaginator->total);
    }

}
