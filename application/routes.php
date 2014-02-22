<?php

use \Laravel\Routing\Route;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
  | breeze to setup your application using Laravel's RESTful routing and it
  | is perfectly suited for building large applications and simple APIs.
  |
  | Let's respond to a simple GET request to http://example.com/hello:
  |
  |		Route::get('hello', function()
  |		{
  |			return 'Hello World!';
  |		});
  |
  | You can even respond to more than one URI:
  |
  |		Route::post(array('hello', 'world'), function()
  |		{
  |			return 'Hello World!';
  |		});
  |
  | It's easy to allow URI wildcards using (:num) or (:any):
  |
  |		Route::put('hello/(:any)', function($name)
  |		{
  |			return "Welcome, $name.";
  |		});
  |
 */


Route::get('/', 'bookmarks@index');

Route::controller('auth');
Route::controller('bookmarks');
Route::controller('about');
Route::controller('bookmarklet');
Route::controller('window');
Route::controller('tags');
Route::controller('profile');


/*
  |--------------------------------------------------------------------------
  | Application 404 & 500 Error Handlers
  |--------------------------------------------------------------------------
  |
  | To centralize and simplify 404 handling, Laravel uses an awesome event
  | system to retrieve the response. Feel free to modify this function to
  | your tastes and the needs of your application.
  |
  | Similarly, we use an event to handle the display of 500 level errors
  | within the application. These errors are fired when there is an
  | uncaught exception thrown in the application.
  |
 */

Event::listen('404', function() {
            return Response::error('404');
        });

Event::listen('500', function() {
            return Response::error('500');
        });

/*
  |--------------------------------------------------------------------------
  | Route Filters
  |--------------------------------------------------------------------------
  |
  | Filters provide a convenient method for attaching functionality to your
  | routes. The built-in before and after filters are called before and
  | after every request to your application, and you may even create
  | other filters that can be attached to individual routes.
  |
  | Let's walk through an example...
  |
  | First, define a filter:
  |
  |		Route::filter('filter', function()
  |		{
  |			return 'Filtered!';
  |		});
  |
  | Next, attach the filter to a route:
  |
  |		Route::get('/', array('before' => 'filter', function()
  |		{
  |			return 'Hello World!';
  |		}));
  |
 */

Route::filter('before', function() {
            // Do stuff before every request to your application...
        });

Route::filter('after', function($response) {
            // Do stuff after every request to your application...
        });

Route::filter('csrf', function() {
            if (Request::forged())
                return Response::error('500');
        });

Route::filter('auth', function() {
            if (Auth::guest()) {
                return Redirect::to_action('auth@login');
            }
        });


        
        
/**
 * Die Popup-Route wird durch eine spezielle Popup-Version
 * der Login-Seite geschützt. Damit nach dem Login wieder zur ursprünglichen
 * Popup-Route (inkl. Query-Parameter) redirected werden kann, muss die aktuelle
 * URL als Session-Data geflashed werden.
 */
Route::filter('authPopup', function() {
            if (Auth::guest()) {
                return Redirect::to_action('auth@popup')->with('popup_full_url', URL::full());
            }
        });
        
/**
 * Filter, um Fremdzugang zu einem Bookmark zu schützen.
 * Es wird ermittelt, ob die Bookmark-ID in der Route zum aktuell eingeloggten User gehört.
 * 
 * $index ist der Index der Bookmark-ID der Route. Lautet die Route z.B. 'edit/123', so
 * ist hat 'edit' den $index=0 und '123' den $index=1.
 * 
 * In einem Controller kann der Filter wie folgt verwendet werden:
 * 
 *      $this->filter('before','access_bookmark:1')
 * 
 */
Route::filter('bookmarksAccess', function($index = 1) {
            $bookmark_id = Request::route()->parameters[$index];

            $bookmarkDAO = IoC::resolve('bookmarkDAO');
            $bookmark = $bookmarkDAO->findById($bookmark_id);
            
            if ($bookmark !== null && Auth::user()->id != $bookmark->user_id) {
                return Response::error('403');
            }
        });

        
/**
 * Die Login-Seite darf nur angezeigt werden,
 * wenn der User NICHT eingeloggt ist.
 * Falls der User eingeloggt ist, wird zur
 * Home-Seite redirected.
 */
Route::filter('loginAccess', function() {
            if (Auth::check()) {
                return Redirect::home();
            }
        });
        

        
//Event::listen('laravel.query', function($sql, $bindings, $time) {
//            Log::info('sql=[' . $sql . '], bindings=[' . implode(', ', $bindings) . '], time=[' . $time .'ms]');
//        });