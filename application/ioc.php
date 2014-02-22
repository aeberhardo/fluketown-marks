<?php

use \Laravel\IoC;

IoC::singleton('bookmarkDAO', function () {
            return new \ch\aeberhardo\dao\impl\BookmarkDAOImpl();
        });

IoC::singleton('tagDAO', function () {
            return new \ch\aeberhardo\dao\impl\TagDAOImpl();
        });

IoC::singleton('userDAO', function () {
            return new \ch\aeberhardo\dao\impl\UserDAOImpl();
        });

IoC::singleton('bookmarksGetIndexAction', function () {
            $bookmarkDAO = IoC::resolve('bookmarkDAO');

            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetIndexAction();
            $action->setBookmarkDAO($bookmarkDAO);

            return $action;
        });

IoC::singleton('bookmarksGetSearchAction', function () {
            $bookmarkDAO = IoC::resolve('bookmarkDAO');

            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetSearchAction();
            $action->setBookmarkDAO($bookmarkDAO);

            return $action;
        });

IoC::singleton('bookmarksGetTagsAction', function () {
            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetTagsAction();

            $action->setBookmarkDAO(IoC::resolve('bookmarkDAO'));
            $action->setTagDAO(IoC::resolve('tagDAO'));

            return $action;
        });

IoC::singleton('bookmarksGetFavoritesAction', function () {
            $action = new \ch\aeberhardo\actions\bookmarks\BookmarksGetFavoritesAction();

            $action->setBookmarkDAO(IoC::resolve('bookmarkDAO'));
            $action->setTagDAO(IoC::resolve('tagDAO'));

            return $action;
        });

IoC::singleton('bookmarksGetShowAction', function () {
            $bookmarkDAO = IoC::resolve('bookmarkDAO');

            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetShowAction();
            $action->setBookmarkDAO($bookmarkDAO);

            return $action;
        });

IoC::singleton('bookmarksGetEditAction', function () {
            $bookmarkDAO = IoC::resolve('bookmarkDAO');

            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetEditAction();
            $action->setBookmarkDAO($bookmarkDAO);

            return $action;
        });

IoC::singleton('bookmarksGetNewAction', function () {
            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetNewAction();
            return $action;
        });

IoC::singleton('bookmarksGetPopupAction', function () {
            $action = new ch\aeberhardo\actions\bookmarks\BookmarksGetPopupAction();
            return $action;
        });


IoC::singleton('bookmarksPostCreateAction', function () {
            $action = new ch\aeberhardo\actions\bookmarks\BookmarksPostCreateAction();
            $action->setBookmarkDAO(IoC::resolve('bookmarkDAO'));
            $action->setTagDAO(IoC::resolve('tagDAO'));
            return $action;
        });

IoC::singleton('bookmarksPostUpdateAction', function () {
            $action = new ch\aeberhardo\actions\bookmarks\BookmarksPostUpdateAction();
            $action->setBookmarkDAO(IoC::resolve('bookmarkDAO'));
            $action->setTagDAO(IoC::resolve('tagDAO'));
            return $action;
        });

IoC::singleton('bookmarksPostDestroyAction', function () {
            $action = new ch\aeberhardo\actions\bookmarks\BookmarksPostDestroyAction();
            $action->setBookmarkDAO(IoC::resolve('bookmarkDAO'));
            return $action;
        });

IoC::singleton('bookmarksGetMissingThumbsJSONAction', function () {
            $action = new \ch\aeberhardo\actions\bookmarks\BookmarksGetMissingThumbsJSONAction();
            $action->setBookmarkDAO(IoC::resolve('bookmarkDAO'));
            return $action;
        });


IoC::singleton('aboutGetIndexAction', function () {
            $action = new \ch\aeberhardo\actions\about\AboutGetIndexAction();
            return $action;
        });

IoC::singleton('bookmarkletGetIndexAction', function () {
            $action = new \ch\aeberhardo\actions\bookmarklet\BookmarkletGetIndexAction();
            return $action;
        });

IoC::singleton('authGetLoginAction', function () {
            $action = new \ch\aeberhardo\actions\auth\AuthGetLoginAction();
            return $action;
        });

IoC::singleton('authGetPopupAction', function () {
            $action = new \ch\aeberhardo\actions\auth\AuthGetPopupAction();
            return $action;
        });

IoC::singleton('authPostLoginAction', function () {
            $action = new \ch\aeberhardo\actions\auth\AuthPostLoginAction();
            return $action;
        });

IoC::singleton('authGetLogoutAction', function () {
            $action = new \ch\aeberhardo\actions\auth\AuthGetLogoutAction();
            return $action;
        });

IoC::singleton('authGetSignupAction', function () {
            $action = new \ch\aeberhardo\actions\auth\AuthGetSignupAction();
            return $action;
        });
        
IoC::singleton('authPostSignupAction', function () {
            $action = new \ch\aeberhardo\actions\auth\AuthPostSignupAction();
            $action->setUserDAO(IoC::resolve('userDAO'));
            return $action;
        });
        
IoC::singleton('tagsGetIndexAction', function () {
            $action = new ch\aeberhardo\actions\tags\TagsGetIndexAction();
            $action->setTagDAO(IoC::resolve('tagDAO'));
            return $action;
        });
        
IoC::singleton('profileGetIndexAction', function () {
            $action = new ch\aeberhardo\actions\profile\ProfileGetIndexAction();
            return $action;
        });
        
IoC::singleton('profilePostUpdateContactAction', function () {
            $action = new \ch\aeberhardo\actions\profile\ProfilePostUpdateContactAction();
            $action->setUserDAO(IoC::resolve('userDAO'));
            return $action;
        });

IoC::singleton('profilePostUpdatePasswordAction', function () {
            $action = new \ch\aeberhardo\actions\profile\ProfilePostUpdatePasswordAction();
            $action->setUserDAO(IoC::resolve('userDAO'));
            return $action;
        });
