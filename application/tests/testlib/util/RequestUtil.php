<?php

namespace testlib\util;

use \Laravel\Request;
use \Symfony\Component\HttpFoundation\LaravelRequest;

final class RequestUtil {

    private function __construct() {
        
    }

    public static function resetRequest() {
        Request::$foundation = LaravelRequest::createFromGlobals();
    }

    public static function addHeader($key, $value) {
        Request::foundation()->headers->add(array($key => $value));
    }

    public static function addReferrer($value) {
        static::addHeader('referer', $value);
    }

}
