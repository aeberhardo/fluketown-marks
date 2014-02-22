<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Redirect;
use \Laravel\Input;

class BookmarksPostDestroyAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @return Redirect
     */
    public function execute($id) {
        $this->bookmarkDAO->deleteById($id);
        return Redirect::to($this->getSuccessUrl());
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

    private function getSuccessUrl() {
        return Input::get('onSuccess');
    }

}
