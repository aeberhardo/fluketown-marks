<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Response;
use \Laravel\File;
use \Laravel\Config;
use \Bookmark;

class BookmarksGetMissingThumbsJSONAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @return Response
     */
    public function execute() {

        $jsonData = array();

        $bookmarks = $this->bookmarkDAO->findAll();

        foreach ($bookmarks as $bookmark) {

            if (!$this->thumbExists($bookmark)) {
                $id = $bookmark->id;
                $url = $bookmark->url;
                $jsonEntry = array('id' => $id, 'url' => $url); // identisch zu $jsonEntry = compact('id', 'url');
                $jsonData[] = $jsonEntry;
            }
        }

        return Response::json($jsonData);
    }

    /**
     * 
     * @param Bookmark $bookmark
     * @return boolean
     */
    private function thumbExists(Bookmark $bookmark) {
        $imagesDirectoryPath = $_SERVER['DOCUMENT_ROOT'] . '/' . Config::get('my.images#path');
        $path = $imagesDirectoryPath . '/' . $bookmark->id . '-thumb.jpg';

        return File::exists($path);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

}
