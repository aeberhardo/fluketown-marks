<?php

namespace ch\aeberhardo\actions\bookmarklet;

use \Laravel\View;

class BookmarkletGetIndexAction {

    /**
     * @return View
     */
    public function execute() {
        return View::make('bookmarklet.index');
    }

}
