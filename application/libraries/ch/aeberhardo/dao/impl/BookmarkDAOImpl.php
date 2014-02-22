<?php

namespace ch\aeberhardo\dao\impl;

use \Laravel\Config;
use \Laravel\Database;
use \Bookmark;
use \User;
use \ch\aeberhardo\dao\BookmarkDAO;
use \ch\aeberhardo\actions\bookmarks\impl\TagLinearizer;

class BookmarkDAOImpl implements BookmarkDAO {

    /**
     * @var int 
     */
    private $bookmarksPerPage;
    
    /**
     * @var int 
     */
    private $favoritesPerPage;

    public function __construct() {
        $this->bookmarksPerPage = Config::get('my.bookmarks#per_page', 5);
        $this->favoritesPerPage = Config::get('my.favorites#per_page', 6);
    }

    public function findById($id) {
        return Bookmark::find($id);
    }

    public function findAll() {
        return Bookmark::all();
    }

    public function findByUserIdAndUrl($userId, $url) {
        return Bookmark::where_user_id($userId)->where_url($url)->first();
    }
    
    public function paginateByUserOrderByCreatedAtDesc(User $user) {
        return $this->bookmarks($user)->order_by('created_at', 'desc')->paginate($this->bookmarksPerPage);
    }

    public function save(Bookmark $bookmark) {
        return $bookmark->save();
    }

    public function saveForUser(User $user, Bookmark $bookmark) {
        return $this->bookmarks($user)->save($bookmark);
    }

    public function paginateTagsByUserOrderByCreatedAtDesc(User $user, $delimitedTagNames) {
        $tagLinearizer = new TagLinearizer();
        $tagNames = $tagLinearizer->toArray($delimitedTagNames);

        $query = $this->createTagsQuery($tagNames);
        $query->where_user_id($user->id);

        $query->order_by('created_at', 'desc');

        return $query->paginate($this->bookmarksPerPage);
    }

    public function paginateSearchByUserOrderByCreatedAtDesc(User $user, $searchTerms) {
        $searchTermsArray = explode(' ', $searchTerms);

        $query = $this->createSearchQuery($searchTermsArray);
        $query->where_user_id($user->id);

        $query->order_by('created_at', 'desc');

        return $query->paginate($this->bookmarksPerPage);
    }

    public function paginateFavoritesByUserOrderByTitle(User $user, $delimitedTagNames) {
        $tagLinearizer = new TagLinearizer();
        $tagNames = $tagLinearizer->toArray($delimitedTagNames);

        $query = $this->createTagsQuery($tagNames);

        $query->where_user_id($user->id);
        $query->where_favorite(true);
        $query->order_by('title', 'asc');

        return $query->paginate($this->favoritesPerPage);
    }

    public function deleteById($id) {
        return Database::table('bookmarks')->delete($id);
    }

    /**
     * 
     * @param array string $searchTerms
     * @return Laravel\Database\Eloquent\Query
     */
    private function createSearchQuery(array $searchTerms) {
        $query = Bookmark::select();

        foreach ($searchTerms as $searchTerm) {

            $query->where(function($q) use ($searchTerm) {

                        $q->where('title', 'like', '%' . $searchTerm . '%')
                                ->or_where('url', 'like', '%' . $searchTerm . '%')
                                ->or_where('description', 'like', '%' . $searchTerm . '%');
                    });
        }

        return $query;
    }

    /**
     * 
     * Generieren des Statements für die Abfrage von Bookmarks nach Tags.
     * 
     * Beispiel:
     * 
     *    SELECT bookmarks.*
     *    FROM bookmarks
     *        INNER JOIN tags AS t0 ON (bookmarks.id = t0.bookmark_id)
     *        INNER JOIN tags AS t1 ON (bookmarks.id = t1.bookmark_id)
     *        INNER JOIN tags AS t2 ON (bookmarks.id = t2.bookmark_id)
     *    WHERE t0.name = 'art'
     *    AND t1.name = 'wallpaper'
     *    AND t2.name = 'design'
     * 
     * @param array string $tagNames
     * @return Laravel\Database\Eloquent\Query
     */
    private function createTagsQuery(array $tagNames) {
        $query = Bookmark::select('bookmarks.*');

        foreach ($tagNames as $i => $tagName) {
            $query->join('tags as t' . $i, 'bookmarks.id', '=', 't' . $i . '.bookmark_id');
        }

        foreach ($tagNames as $i => $tagName) {
            $query->where('t' . $i . '.name', '=', $tagName);
        }

        return $query;
    }

    /**
     * @param User $user
     * @return \Laravel\Database\Eloquent\Relationships\Has_Many
     */
    private function bookmarks(User $user) {
        return $user->has_many('Bookmark');
    }

}
