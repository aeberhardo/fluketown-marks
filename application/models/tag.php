<?php

use Laravel\Database\Eloquent\Model;
use ch\aeberhardo\validators\tags\TagsValidator;

class Tag extends Model {

    // TODO: In BookmarkDAO
//    public function bookmark() {
//        return $this->belongs_to('Bookmark');
//    }

    public function save() {
        $this->validate();
        parent::save();
    }

    public function validate() {
        TagsValidator::validate($this);
    }



}
