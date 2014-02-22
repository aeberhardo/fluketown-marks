<?php

namespace ch\aeberhardo\actions\auth;

use \Laravel\Input;
use \Laravel\View;
use \Laravel\Session;
use \ch\aeberhardo\url\URLManager;

class AuthGetPopupAction {

    /**
     * Die Action erstellt die Login-Seite im Popup-Fenster.
     * 
     * @return View
     */
    public function execute() {
        return View::make('auth.popup')
                        ->with('username', Input::old('username'))
                        ->with('urlManagerForLogin', $this->createURLManagerForLogin());
    }

    /**
     * URLManager konfigurieren.
     * Dabei wird die "onSuccess"-Variable entweder
     * aus der Session geholt (flashed Data aus dem Filter) oder
     * aus den old Formular-Input-Daten (wenn Login falsch eingegeben wurde).
     * 
     * @return URLManager
     */
    private function createURLManagerForLogin() {
        return URLManager::make()
                        ->set('onSuccess', function() {
                                    return Session::get('popup_full_url');
                                });
    }

}
