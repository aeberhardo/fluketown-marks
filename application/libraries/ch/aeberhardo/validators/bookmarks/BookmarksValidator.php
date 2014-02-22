<?php

namespace ch\aeberhardo\validators\bookmarks;

use \Laravel\Validator;
use \Laravel\IoC;
use \Bookmark;
use \ch\aeberhardo\dao\BookmarkDAO;
use \ch\aeberhardo\validators\ValidationException;

class BookmarksValidator {

    private function __construct() {
        
    }

    /**
     * @param Bookmark $bookmark
     * @throws ValidationException
     */
    public static function validate(Bookmark $bookmark) {

        $validator = static::validator($bookmark);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors);
        }

        static::validateUrlUniqueForUser($bookmark);
    }

    /**
     * @param Bookmark $bookmark
     * @return Validator
     */
    private static function validator(Bookmark $bookmark) {

        $rules = array(
            'url' => 'required|url|max:500',
            'title' => 'required|max:200',
            'description' => 'max:1000',
            'favorite' => 'numeric|in:0,1',
        );

        $validator = Validator::make($bookmark->to_array(), $rules);
        return $validator;
    }

    /**
     * Validieren, dass für einen User die BookmarkUrl unique in der Datenbank ist.
     * 
     * Falls in der Datenbank ein Bookmark mit derselben UserId/URL gefunden wird,
     * dann darf es sich bloss um einen Eintrag handeln, der dieselbe BookmarkId besitzt.
     * In diesem Fall handelt es sich um ein Update eines bestehenden Bookmarks und ist erlaubt.
     * 
     * @param Bookmark $bookmark
     * @throws ValidationException
     */
    private static function validateUrlUniqueForUser(Bookmark $bookmark) {
        $userId = $bookmark->user_id;
        $url = $bookmark->url;
        $persistedBookmark = static::getBookmarkDAO()->findByUserIdAndUrl($userId, $url);

        if ($persistedBookmark !== null && $bookmark->id !== $persistedBookmark->id) {
            throw new ValidationException('Flukemark with the same URL already exists.');
        }
    }

    /**
     * @return BookmarkDAO
     */
    private static function getBookmarkDAO() {
        return IoC::resolve('bookmarkDAO');
    }

}