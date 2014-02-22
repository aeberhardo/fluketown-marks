<?php

namespace testlib\util;

final class EnvUtil {

    private function __construct() {
        
    }

    public static function isTestEnvOrDie() {
        static::isEnvOrDie('test');
    }
    
    public static function isEnvOrDie($environment) {
        $currentEnv = \Laravel\Request::env();
        if ($currentEnv != $environment) {
            echo "ERROR: Expected environment is '" . $environment . "'. Currently active environment is '" . $currentEnv . "'.\n";
            die;
        }
    }

}

