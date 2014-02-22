<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\Database;
use \Laravel\Redirect;
use \Laravel\Input;
use \Laravel\Auth;
use \User;
use \Bookmark;
use \ch\aeberhardo\validators\forms\BookmarkFormValidator;
use \ch\aeberhardo\validators\ValidationException;
use \ch\aeberhardo\actions\bookmarks\impl\DelimitedTagNamesToModelConverter;

class BookmarksPostCreateAction {

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
    public function execute() {

        try {
            $this->validateInput();

            $bookmark = $this->createBookmarkFromInput();

            $tags = $this->createTagsFromInput();

            $user = Auth::user();

            $this->persist($user, $bookmark, $tags);

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
     * @param User $user
     * @param Bookmark $bookmark
     * @param array Tag $tags
     */
    private function persist(User $user, Bookmark $bookmark, array $tags) {
        Database::transaction(function() use ($user, $bookmark, $tags) {

                    $this->bookmarkDAO->saveForUser($user, $bookmark);

                    foreach ($tags as $tag) {
                        $this->tagDAO->saveForBookmark($tag, $bookmark);
                    }
                });
    }

    /**
     * @return Bookmark
     */
    private function createBookmarkFromInput() {
        $url = Input::get('url');
        $title = Input::get('title');
        $description = Input::get('description');
        $favorite = Input::get('favorite', (int) false);

        $bookmark = new Bookmark();
        $bookmark->url = $url;
        $bookmark->title = $title;
        $bookmark->description = $description;
        $bookmark->favorite = $favorite;

        return $bookmark;
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
