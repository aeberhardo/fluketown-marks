<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Auth;
use \Laravel\View;
use \Laravel\Input;
use \ch\aeberhardo\actions\bookmarks\impl\TagLinearizer;

class BookmarksGetTagsAction {

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

        $bookmarks = $this->bookmarkDAO->paginateTagsByUserOrderByCreatedAtDesc($user, $delimitedTagNames);

        $tagLinearizer = new TagLinearizer();
        $searchTags = $tagLinearizer->toArray($delimitedTagNames);

        $relatedTagCounts = $this->tagDAO->groupRelatedTagsByUserOrderByCountDesc($user, $delimitedTagNames);

        return View::make('bookmarks.tags')
                        ->with('bookmarks', $bookmarks)
                        ->with('relatedTagCounts', $relatedTagCounts)
                        ->with('searchTags', $searchTags);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

    public function setTagDAO($tagDAO) {
        $this->tagDAO = $tagDAO;
    }

}
