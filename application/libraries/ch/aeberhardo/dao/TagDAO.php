<?php

namespace ch\aeberhardo\dao;

use \Tag;
use \Bookmark;
use \User;

interface TagDAO {

    /**
     * @param Tag $tag
     * @param Bookmark $bookmark
     * @return bool
     */
    function saveForBookmark(Tag $tag, Bookmark $bookmark);

    /**
     * @param Bookmark $bookmark
     * @return array Tag
     */
    function findByBookmark(Bookmark $bookmark);
    
    /**
     * @param Bookmark $bookmark
     */
    function deleteByBookmark(Bookmark $bookmark);
    
    /**
     * 
     * @param User $user
     * @return array Ein Array von Objekten. Jedes Objekt enthält "name" (Tag-Name) und "count" (Anzahl Tags für den User).
     */
    function groupByUserOrderByNameAsc(User $user);
    
    /**
     * 
     * @param User $user
     * @param string $delimitedTagNames
     * @return array Ein Array von Objekten. Jedes Objekt enthält "name" (Tag-Name) und "count" (Anzahl Tags für den User).
     */
    function groupRelatedTagsByUserOrderByCountDesc(User $user, $delimitedTagNames);
    
    
    
    /**
     * @param User $user
     */
    function groupFavoriteTagsByUserOrderByNameAsc(User $user);
}

