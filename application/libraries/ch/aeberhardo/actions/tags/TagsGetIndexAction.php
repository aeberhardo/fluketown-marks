<?php

namespace ch\aeberhardo\actions\tags;

use \Laravel\Auth;
use \Laravel\View;

class TagsGetIndexAction {

    /**
     * @var \ch\aeberhardo\dao\TagDAO
     */
    private $tagDAO;

    /**
     * @return View
     */
    public function execute() {

        $user = Auth::user();

        $tagCounts = $this->tagDAO->groupByUserOrderByNameAsc($user);

        return View::make('tags.index')
                        ->with('tagCounts', $tagCounts);
    }

    public function setTagDAO($tagDAO) {
        $this->tagDAO = $tagDAO;
    }

}
