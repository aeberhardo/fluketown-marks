<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\View;
use \Laravel\Auth;

class BookmarksGetIndexAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @return View
     */
    public function execute() {
        
        $user = Auth::user();
        $bookmarks = $this->bookmarkDAO->paginateByUserOrderByCreatedAtDesc($user);

        return View::make('bookmarks.index')
                        ->with('bookmarks', $bookmarks);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

}
