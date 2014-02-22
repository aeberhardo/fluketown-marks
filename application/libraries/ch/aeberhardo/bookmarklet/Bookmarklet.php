<?php

namespace ch\aeberhardo\bookmarklet;

use Laravel\URL;

class Bookmarklet {

    private function __construct() {
        
    }

    public static function get() {
        return static::getCompressed();
    }

    private static function getCompressed() {
        $js = static::createBookmarkletJS();
        return str_replace(array(" ", "\r", "\n", "\t"), '', $js);
    }
    
    private static function createBookmarkletJS() {
        $js = "javascript:(function() {
                   w = 800;
                   h = 690;
                   yoff = -100;
                   x = (screen.width-w)/2;
                   y = yoff + (screen.height-h)/2;

                   u=encodeURIComponent(document.location.href);
                   t=encodeURIComponent(document.title);
                   d=encodeURIComponent(window.getSelection());

                   q='?url=' + u + '&title=' + t + '&description=' + d;

                   window.open('" . URL::to_action('bookmarks@popup') . "' + q, '', 'left=' + x + ', top=' + y + ', width=' + w + ', height=' + h + ', menubar=0, scrollbars=0, status=0, toolbar=0, location=0, resizable=1, alwaysRaised=1')})
                   ()";
        return $js;
    }

}

