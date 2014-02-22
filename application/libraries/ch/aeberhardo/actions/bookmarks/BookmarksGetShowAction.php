<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\View;
use \Laravel\Response;

class BookmarksGetShowAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @return View|Response
     */
    public function execute($id) {
        $bookmark = $this->bookmarkDAO->findById($id);
        
        if ($bookmark === null) {
            return Response::error('404');
        }
        
        return View::make('bookmarks.show')->with('bookmark', $bookmark);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

}
