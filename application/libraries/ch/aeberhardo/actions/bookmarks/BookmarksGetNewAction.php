<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\View;
use \Laravel\Input;
use \ch\aeberhardo\url\URLManager;

class BookmarksGetNewAction {

    /**
     * @return \Laravel\View
     */
    public function execute() {

        return View::make('bookmarks.new')
                        ->with('url', Input::old('url', 'http://'))
                        ->with('title', Input::old('title'))
                        ->with('description', Input::old('description'))
                        ->with('tags', Input::old('tags'))
                        ->with('favorite', Input::old('favorite', false))
                        ->with('urlManagerForCreate', $this->createURLManagerForCreate());
    }

    private function createURLManagerForCreate() {
        return URLManager::make()
                        ->home('onSuccess')
                        ->home('onCancel');
    }

}
