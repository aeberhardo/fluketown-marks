<?php

namespace ch\aeberhardo\html;

use \Laravel\HTML;

class HTMLFavicon {

    public static function faviconImage($url) {
        $host = parse_url($url, PHP_URL_HOST);
        return HTML::image('http://www.google.com/s2/favicons?domain=' . $host);
    }

}

