<?php
require_once 'ioc.php';
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['before' => 'encode-input'], function(){
	Route::get('/signup', ['as' => 'signup.get', 'uses' =>'SignupController@getSignup']);
	Route::post('/signup', ['as' => 'signup.post', 'uses' =>'SignupController@postSignup']);
	Route::get('/confirm/{code}', ['as' => 'signup.activation', 'uses' =>'SignupController@activation']);

	Route::get('/login', ['as' => 'login.get', 'uses' =>'LoginController@getLogin']);
	Route::post('/login', ['as' => 'login.post', 'uses' =>'LoginController@postLogin']);
	Route::get('/logout', ['as' => 'logout', 'uses' =>'LoginController@getLogout']);

	Route::group(['before' => 'auth'], function (){
		Route::get('/', function()
		{
			return Redirect::route('properties.index');
		});
		Route::post('/properties/{properties}/pause', ['as' => 'properties.pause', 'uses' => 'PropertyController@pause']);
		Route::post('/properties/{properties}/reactivate', ['as' => 'properties.reactivate', 'uses' => 'PropertyController@reactivate']);
		Route::post('/properties/{properties}/delete', ['as' => 'properties.delete', 'uses' => 'PropertyController@delete']);
		Route::resource('/properties', 'PropertyController');
	});



	Route::group(['before' => '', 'prefix' => 'api'], function(){
		Route::get('/property-search', 'ApiController@propertySearch');
		Route::get('/property', 'ApiController@property');
    Route::get('/definitions', 'ApiController@definitions');
	});
});


App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');
