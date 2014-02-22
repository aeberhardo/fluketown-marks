<?php

namespace ch\aeberhardo\url;

use \Closure;
use \Laravel\Input;
use \Laravel\Request;
use \Laravel\URL;

class URLManager {

    private $urlMap = array();
    
    private function __construct() {

    }

    public static function make() {
        return new URLManager();
    }

    public function set($name, Closure $defaultURL) {

        if (Input::had($name)) {
            $this->urlMap[$name] = Input::old($name);
        } else {
            $this->urlMap[$name] = $defaultURL();
        }

        return $this;
    }

    public function referrer($name) {

        $this->set($name, function() {
                    $url = Request::referrer();
                    if ($url === null) {
                        $url = URL::home();
                    }
                    return $url;
                });

        return $this;
    }

    public function home($name) {

        $this->set($name, function() {
                    return URL::home();
                });

        return $this;
    }

    public function getURL($name) {

        if (!array_key_exists($name, $this->urlMap)) {
            return '#';
        }
        return $this->urlMap[$name];
    }

    public function __get($name) {
        return $this->getURL($name);
    }

    public function toHTML() {
        $html = '';
        foreach ($this->urlMap as $name => $url) {
            $html .= '<input type="hidden" name="' . $name . '" value="' . $url . '">';
        }
        return $html;
    }

}

