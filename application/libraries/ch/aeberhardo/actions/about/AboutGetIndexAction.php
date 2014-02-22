<?php

namespace ch\aeberhardo\actions\about;

use \Laravel\View;
use \Laravel\Config;

class AboutGetIndexAction {

    /**
     * @return View
     */
    public function execute() {
        $version = Config::get('my.build#version');
        $timestamp = Config::get('my.build#timestamp');
        
        return View::make('about.index')
                ->with(compact('version', 'timestamp'));
    }

}
