<?php

namespace ch\aeberhardo\dao\impl;

use \Laravel\Database;
use \Tag;
use \Bookmark;
use \User;
use \ch\aeberhardo\dao\TagDAO;
use \ch\aeberhardo\actions\bookmarks\impl\TagLinearizer;

class TagDAOImpl implements TagDAO {

    function saveForBookmark(Tag $tag, Bookmark $bookmark) {
        return $this->tags($bookmark)->save($tag);
    }

    public function findByBookmark(Bookmark $bookmark) {
        return $this->tags($bookmark)->get();
    }

    public function deleteByBookmark(Bookmark $bookmark) {
        return $this->tags($bookmark)->delete();
    }

    /**
     * @param Bookmark $bookmark
     * @return \Laravel\Database\Eloquent\Relationships\Has_Many
     */
    private function tags(Bookmark $bookmark) {
        return $bookmark->has_many('Tag')->order_by('name');
    }

    public function groupByUserOrderByNameAsc(User $user) {
        $resultSet = Database::query(
                        'select t.name, count(*) as count
                 from bookmarks b
                 inner join tags t on (b.id = t.bookmark_id)
                 where b.user_id = ?
                 group by t.name
                 order by t.name;', array($user->id));
        return $resultSet;
    }

    
    
    /**
     * Related Tags für einen User und mehreren Tags ermitteln.
     * 
     * Beispiel:
     * 
     *   SELECT DISTINCTROW t.name, COUNT(b.id) AS count
     *   FROM
     *       bookmarks b
     *       inner join tags t on (b.id = t.bookmark_id and t.name not in ('3d','code', 'java'))
     *       inner join tags t1 on (b.id = t1.bookmark_id and t1.name = '3d')
     *       inner join tags t2 on (b.id = t2.bookmark_id and t2.name = 'code')
     *       inner join tags t3 on (b.id = t3.bookmark_id and t3.name = 'java' )
     *   WHERE b.user_id = 1
     *   GROUP BY t.name
     *   ORDER BY count DESC , t.name;
     * 
     * @param User $user
     * @param string $delimitedTagNames
     * @return array Objekte, welche die Eigenschaften 'name' und 'count' besitzen.
     */
    public function groupRelatedTagsByUserOrderByCountDesc(User $user, $delimitedTagNames) {
        $tagLinearizer = new TagLinearizer();
        $tagNames = $tagLinearizer->toArray($delimitedTagNames);


        if (count($tagNames) <= 0) {
            return array();
        }

        // Generieren von Fragezeichen-Platzhaltern, z.B. '?,?,?'.
        $placeholders = implode(',', array_fill(0, count($tagNames), '?'));


        $query = 'SELECT DISTINCTROW t.name, COUNT(b.id) AS count
                  FROM bookmarks b
                  INNER JOIN tags t ON (b.id = t.bookmark_id and t.name not in (' . $placeholders . '))';

        for ($i = 1; $i <= count($tagNames); $i++) {
            $query .= ' INNER JOIN tags t' . $i . ' ON (b.id = t' . $i . '.bookmark_id and t' . $i . '.name = ?) ';
        }

        $query .= ' WHERE b.user_id = ? GROUP BY t.name ORDER BY count DESC, t.name;';

        $parameters = array_merge($tagNames, $tagNames, array($user->id));

        $resultSet = Database::query($query, $parameters);

        return $resultSet;
    }

    public function groupFavoriteTagsByUserOrderByNameAsc(User $user) {

        $query = 'SELECT t.name, COUNT(*) AS count
                  FROM tags t
                  JOIN bookmarks b ON (t.bookmark_id = b.id)
                  WHERE b.user_id = ?
                  AND b.favorite = 1
                  GROUP BY t.name
                  ORDER BY t.name;';

        $parameters = array($user->id);

        $resultSet = Database::query($query, $parameters);

        return $resultSet;
    }

}

