<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Input;

class BookmarksGetSearchAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @return View
     */
    public function execute() {

        $searchTerms = Input::get('q');
        
        $user = Auth::user();

        $bookmarks = $this->bookmarkDAO->paginateSearchByUserOrderByCreatedAtDesc($user, $searchTerms);

        return View::make('bookmarks.search')
                        ->with('bookmarks', $bookmarks);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

}
