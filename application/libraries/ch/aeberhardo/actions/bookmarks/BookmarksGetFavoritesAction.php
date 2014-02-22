<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Input;

class BookmarksGetFavoritesAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @var \ch\aeberhardo\dao\TagDAO
     */
    private $tagDAO;

    /**
     * @return View
     */
    public function execute() {
        $delimitedTagNames = Input::get('t');

        $user = Auth::user();

        $bookmarks = $this->bookmarkDAO->paginateFavoritesByUserOrderByTitle($user, $delimitedTagNames);
        
        $favoriteTagCounts = $this->tagDAO->groupFavoriteTagsByUserOrderByNameAsc($user);

        return View::make('bookmarks.favorites')
                        ->with('bookmarks', $bookmarks)
                        ->with('favoriteTagCounts', $favoriteTagCounts);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

    public function setTagDAO($tagDAO) {
        $this->tagDAO = $tagDAO;
    }

}
