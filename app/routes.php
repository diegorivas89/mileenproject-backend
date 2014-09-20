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
	Route::get('/', function()
	{
		return Redirect::route('properties.index');
	});

	Route::resource('/properties', 'PropertyController');

	Route::group(['before' => '', 'prefix' => 'api'], function(){
		Route::get('/property-search', 'ApiController@propertySearch');
		Route::get('/property', 'ApiController@property');
	});
});


App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');
