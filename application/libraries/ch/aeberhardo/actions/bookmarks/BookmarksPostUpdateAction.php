<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Database;
use \Laravel\Redirect;
use \Laravel\Input;

use \Bookmark;

use \ch\aeberhardo\validators\forms\BookmarkFormValidator;
use \ch\aeberhardo\validators\ValidationException;
use \ch\aeberhardo\actions\bookmarks\impl\DelimitedTagNamesToModelConverter;

class BookmarksPostUpdateAction {

    /**
     * @var \ch\aeberhardo\dao\BookmarkDAO
     */
    private $bookmarkDAO;

    /**
     * @var \ch\aeberhardo\dao\TagDAO
     */
    private $tagDAO;
    
    /**
     * @return Redirect
     */
    public function execute($id) {
        try {
            $this->validateInput();
            
            $bookmark = $this->bookmarkDAO->findById($id);
            $this->updateBookmarkWithInput($bookmark);
            
            // Zeitstempel auf Bookmark in jedem Fall neu setzen.
            $bookmark->timestamp();

            $tags = $this->createTagsFromInput();

            $this->persist($bookmark, $tags);

            return Redirect::to($this->getSuccessUrl());
        } catch (ValidationException $e) {
            return Redirect::back()->with_input()->with_errors($e->getValidationMessages());
        }
    }

    private function getSuccessUrl() {
        return Input::get('onSuccess');
    }
    
    private function validateInput() {
        BookmarkFormValidator::validate(Input::get());
    }
    
    /**
     * Bookmark und zugehörige Tags in einer Transaktion persistieren.
     * @param Bookmark $bookmark
     * @param array Tag $tags
     */
    private function persist(Bookmark $bookmark, array $tags) {
        Database::transaction(function() use ($bookmark, $tags) {

                    $this->bookmarkDAO->save($bookmark);
                    $this->tagDAO->deleteByBookmark($bookmark);

                    foreach ($tags as $tag) {
                        $this->tagDAO->saveForBookmark($tag, $bookmark);
                    }
                });
    }

    private function updateBookmarkWithInput($bookmark) {
        $url = Input::get('url');
        $title = Input::get('title');
        $description = Input::get('description');
        $favorite = Input::get('favorite', (int)false);

        $bookmark->url = $url;
        $bookmark->title = $title;
        $bookmark->description = $description;
        $bookmark->favorite = $favorite;
    }

    /**
     * @return array Tag
     */
    private function createTagsFromInput() {
        $delimitedTagNames = Input::get('tags');
        
        $converter = new DelimitedTagNamesToModelConverter();
        return $converter->convert($delimitedTagNames);
    }

    public function setBookmarkDAO($bookmarkDAO) {
        $this->bookmarkDAO = $bookmarkDAO;
    }

    public function setTagDAO($tagDAO) {
        $this->tagDAO = $tagDAO;
    }

}
