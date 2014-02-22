<?php

namespace ch\aeberhardo\url;

use \ch\aeberhardo\url\URLHelper;
use \ch\aeberhardo\actions\bookmarks\impl\TagLinearizer;

class TagURLHelper {

    public static function to_action($action, $tagName) {
        return URLHelper::to_action_with_query_string($action, array('t' => $tagName));
    }
    
    public static function to_action_adding_tag($action, $delimitedTagNames, $addTagName) {
        $tagLinearizer = new TagLinearizer();
        $tagNames = $tagLinearizer->toArray($delimitedTagNames);
        $tagNames[] = $addTagName;
        return static::to_action($action, implode(',', $tagNames));
    }

    public static function to_action_removing_tag($action, $delimitedTagNames, $removeTagName) {
        $tagLinearizer = new TagLinearizer();
        $tagNames = $tagLinearizer->toArray($delimitedTagNames);
        
        $shrinkedTagNames = array_diff($tagNames, array($removeTagName));
        
        return static::to_action($action, implode(',', $shrinkedTagNames));
    }
    
}

