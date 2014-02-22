<?php

namespace ch\aeberhardo\actions\bookmarks\impl;

class TagLinearizer {

    /**
     * @param string $delimitedTagNames
     * @return array string
     */
    public function toArray($delimitedTagNames) {
        if ($delimitedTagNames == '') {
            return array();
        }

        $tagNames = explode(',', $delimitedTagNames);

        foreach ($tagNames as $key => $tagName) {
            $trimmedTagName = trim($tagName);

            if ($trimmedTagName == '') {
                unset($tagNames[$key]);
            } else {
                $tagNames[$key] = trim($tagName);
            }
        }

        return array_unique($tagNames);
    }

    /**
     * 
     * @param array \Tag $tags
     */
    public function toString(array $tags = null) {

        if ($tags === null) {
            return '';
        }
        
        $tagNames = array();

        foreach ($tags as $tag) {
            $tagNames[] = $tag->name;
        }

        return implode(', ', $tagNames);
    }

}
