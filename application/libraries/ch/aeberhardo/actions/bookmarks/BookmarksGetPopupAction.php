<?php

namespace ch\aeberhardo\actions\bookmarks;

use \Laravel\View;
use \Laravel\Input;
use \Laravel\URL;
use \ch\aeberhardo\url\URLManager;

class BookmarksGetPopupAction {

    /**
     * @return \Laravel\View
     */
    public function execute() {

        $data = $this->createViewData();

        return View::make('bookmarks.popup')
                        ->with($data)
                        ->with('urlManagerForCreate', $this->createURLManagerForCreate());
    }

    private function createURLManagerForCreate() {
        return URLManager::make()
                        ->set('onSuccess', function() {
                                    return URL::to_action('window@close');
                                });
    }

    private function createViewData() {
        $data = array();

        // Daten, welche aus den Query-Parameter oder aus Old Data stammen.
        $data['url'] = $this->getUrlData();
        $data['title'] = $this->getTitleData();
        $data['description'] = $this->getDescriptionData();
        $data['tags'] = $this->getTagsData();

        // Favorite stammt aus Old Data oder ist sonst false.
        $data['favorite'] = $this->getFavoriteData();

        return $data;
    }

    private function getUrlData() {
        return $this->getAttributeData('url');
    }

    private function getTitleData() {
        return $this->getAttributeData('title');
    }

    private function getDescriptionData() {
        return $this->getAttributeData('description');
    }

    private function getTagsData() {
        return $this->getAttributeData('tags');
    }

    private function getFavoriteData() {
        return Input::old('favorite', false);
    }

    /**
     * Daten entweder aus Query-Parameter (Input::get) oder old data beziehen (Input::old).
     * 
     * @param string $attribute
     * @return string
     */
    private function getAttributeData($attribute) {
        $old = Input::old($attribute);
        if ($old) {
            return $old;
        } else {
            return Input::get($attribute);
        }
    }

}
