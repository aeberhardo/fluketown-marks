<?php

namespace ch\aeberhardo\dao;

use \User;
use \Bookmark;

interface BookmarkDAO {

    /**
     * @return Bookmark
     */
    function findById($id);

    /**
     * @return Bookmark[]
     */
    function findAll();
    
    /**
     * @param type $userId
     * @param type $url
     * @return Bookmark
     */
    function findByUserIdAndUrl($userId, $url);

    /**
     * @return \Laravel\Paginator
     */
    function paginateByUserOrderByCreatedAtDesc(User $user);

    /**
     * @return \Laravel\Paginator
     */
    function paginateSearchByUserOrderByCreatedAtDesc(User $user, $searchTerms);

    /**
     * @return \Laravel\Paginator
     */
    public function paginateTagsByUserOrderByCreatedAtDesc(User $user, $delimitedTagNames);
    
    /**
     * @return \Laravel\Paginator
     */
    public function paginateFavoritesByUserOrderByTitle(User $user, $delimitedTagNames);
    
    /**
     * @param Bookmark $bookmark
     * @return bool
     */
    function save(Bookmark $bookmark);

    /**
     * @param User $user
     * @param Bookmark $bookmark
     * @return bool
     */
    function saveForUser(User $user, Bookmark $bookmark);
    
    
    /**
     * @param int $id ID of the bookmark to be deleted.
     */
    function deleteById($id);
    
}

