<?php

use \Laravel\IoC;
use Laravel\Database\Eloquent\Model;
use \ch\aeberhardo\dao\TagDAO;
use ch\aeberhardo\validators\bookmarks\BookmarksValidator;

class Bookmark extends Model {

    /**
     * @return array Tag
     */
    public function tags() {
        return $this->getTagDAO()->findByBookmark($this);
    }

    public function save() {
        $this->validate();
        parent::save();
    }

    public function validate() {
        BookmarksValidator::validate($this);
    }

    /**
     * @return TagDAO
     */
    private function getTagDAO() {
        return IoC::resolve('tagDAO');
    }

}
