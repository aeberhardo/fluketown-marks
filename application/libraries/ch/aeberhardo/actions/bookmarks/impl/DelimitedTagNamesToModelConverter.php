<?php

namespace ch\aeberhardo\actions\bookmarks\impl;

use \Tag;

class DelimitedTagNamesToModelConverter {

    /**
     * @param string $delimitedTagNames
     * @return array Tag
     */
    public function convert($delimitedTagNames) {
        $tagLinearizer = new TagLinearizer();
        $tagNames = $tagLinearizer->toArray($delimitedTagNames);

        if (count($tagNames) <= 0) {
            return array();
        }

        $tagModels = array();
        foreach ($tagNames as $tagName) {
            $tagModel = new Tag();
            $tagModel->name = trim($tagName);
            $tagModels[] = $tagModel;
        }

        return $tagModels;
    }

}
