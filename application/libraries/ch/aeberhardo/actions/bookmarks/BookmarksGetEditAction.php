<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Input;
use \Laravel\View;
use \Bookmark;
use \ch\aeberhardo\actions\bookmarks\impl\TagLinearizer;
use \ch\aeberhardo\url\URLManager;

class BookmarksGetEditAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @return View
     */
    public function execute($id) {
        $data = $this->createData($id);

        return View::make('bookmarks.edit')
                        ->with($data)
                        ->with('urlManagerForUpdate', $this->createURLManagerForUpdate())
                        ->with('urlManagerForDestroy', $this->createURLManagerForDestroy());
    }

    private function createURLManagerForUpdate() {
        return URLManager::make()
                        ->referrer('onSuccess')
                        ->referrer('onCancel');
    }

    private function createURLManagerForDestroy() {
        return URLManager::make()->referrer('onSuccess');
    }

    /**
     * @param int $id The ID of the bookmark to edit.
     * @return array Bookmark data to be passed to the view.
     */
    private function createData($id) {
        if ($this->hasOldInput()) {
            return $this->createDataFromOldInput($id);
        } else {
            return $this->createDataFromDAO($id);
        }
    }

    private function hasOldInput() {
        return count(Input::old()) > 0;
    }

    private function createDataFromOldInput($id) {
        $data = Input::old();
        $data['id'] = $id;

        // Checkbox-Data ist in Old-Input nur gesetzt, wenn sie aktiviert wurde.
        if (!array_key_exists('favorite', $data)) {
            $data['favorite'] = false;
        }

        return $data;
    }

    private function createDataFromDAO($id) {
        $bookmark = $this->bookmarkDAO->findById($id);
        $data = $bookmark->to_array();
        $data['tags'] = $this->createDelimitedTagNames($bookmark);
        return $data;
    }

    private function createDelimitedTagNames(Bookmark $bookmark) {
        $tagLinearizer = new TagLinearizer();
        return $tagLinearizer->toString($bookmark->tags());
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

}
