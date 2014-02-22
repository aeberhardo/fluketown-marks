<?php

class Bookmarks_Controller extends Base_Controller {

    public $restful = true;

    public function __construct() {
        $this->filter('before','auth')->except(array('popup', 'missing_thumbs_json'));
        $this->filter('before','authPopup')->only(array('popup'));
        $this->filter('before','bookmarksAccess:1')->only(array('show','edit','update', 'destroy'));
    }

    function get_index() {
        $action = IoC::resolve('bookmarksGetIndexAction');
        return $action->execute();
    }

    function get_search() {
        $action = IoC::resolve('bookmarksGetSearchAction');
        return $action->execute();
    }

    function get_tags() {
        $action = IoC::resolve('bookmarksGetTagsAction');
        return $action->execute();
    }

    function get_show($id) {
        $action = IoC::resolve('bookmarksGetShowAction');
        return $action->execute($id);
    }

    function get_edit($id) {
        $action = IoC::resolve('bookmarksGetEditAction');
        return $action->execute($id);
    }

    function get_new() {
        $action = IoC::resolve('bookmarksGetNewAction');
        return $action->execute();
    }

    function get_popup() {
        $action = IoC::resolve('bookmarksGetPopupAction');
        return $action->execute();
    }
    
    function get_favorites() {
        $action = IoC::resolve('bookmarksGetFavoritesAction');
        return $action->execute();
    }

    function post_create() {
        $action = IoC::resolve('bookmarksPostCreateAction');
        return $action->execute();
    }

    function post_update($id) {
        $action = IoC::resolve('bookmarksPostUpdateAction');
        return $action->execute($id);
    }

    function post_destroy($id) {
        $action = IoC::resolve('bookmarksPostDestroyAction');
        return $action->execute($id);
    }

    function get_missing_thumbs_json() {
        $action = IoC::resolve('bookmarksGetMissingThumbsJSONAction');
        return $action->execute();
    }

}