<?php

namespace ch\aeberhardo\url;

use \Laravel\URL;
use \Laravel\Config;
use \Laravel\File;
use \Laravel\Request;

class ThumbnailURLHelper {

    /**
     * @param int $id
     * @return string
     */
    public static function to_thumbnail($id) {
        $filename = static::createFilename($id);

        if (static::exists($filename)) {
            return static::createURLToImage($filename);
        } else {
            return static::createURLToPlaceholder();
        }
    }

    /**
     * @param int $id
     * @return string
     */
    private static function createFilename($id) {
        return $id . '-thumb.jpg';
    }

    /**
     * @param string $filename
     * @return string
     */
    private static function createURLToImage($filename) {
        $schemeAndHttpHost = Request::getSchemeAndHttpHost();
        return $schemeAndHttpHost . '/' . Config::get('my.images#url') . '/' . $filename;
    }

    /**
     * @return string
     */
    private static function createURLToPlaceholder() {
        return URL::to_asset('img/thumb-placeholder.jpg');
    }

    /**
     * @param string $filename
     * @return bool
     */
    private static function exists($filename) {
        return File::exists($_SERVER['DOCUMENT_ROOT'] . '/' . Config::get('my.images#path') . '/' . $filename);
    }

}

