<?php

namespace testlib\util;

use \Laravel\View;
use \Laravel\Event;

final class ViewComposerUtil {

    private function __construct() {
        
    }

    /**
     * Die registrierten View Composers einer View ausführen.
     * 
     * @see View.render()
     * @param View $view
     */
    public static function fire(View $view) {
        Event::fire("laravel.composing: {$view->view}", array($view));
    }

}