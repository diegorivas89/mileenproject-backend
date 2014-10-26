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

	Route::get('/pie-chart', function(){
		require_once app_path().'/libs/jpgraph/src/jpgraph.php';
		require_once app_path().'/libs/jpgraph/src/jpgraph_pie.php';

		$data = array(40,60,21,33);

		$graph = new PieGraph(500, 400);
		$graph->SetShadow();

		$graph->title->Set("A simple Pie plot");

		$p1 = new PiePlot($data);
		$graph->Add($p1);
		$graph->Stroke();

	});

	Route::get('/bar-chart', function(){
		require_once app_path().'/libs/jpgraph/src/jpgraph.php';
		require_once app_path().'/libs/jpgraph/src/jpgraph_bar.php';

		$datay=array(12,8,19,3,10,5);

		// Create the graph. These two calls are always required
		$graph = new Graph(600,400);
		$graph->SetScale('intlin');

		// Add a drop shadow
		$graph->SetShadow();

		// Adjust the margin a bit to make more room for titles
		$graph->SetMargin(40,30,20,40);

		// Create a bar pot
		$bplot = new BarPlot($datay);

		// Adjust fill color
		$bplot->SetFillColor('orange');
		$graph->Add($bplot);

		// Setup the titles
		$graph->title->Set('A basic bar graph');
		//$graph->title->SetFont(FF_ARIAL,FS_BOLD,14);
		$graph->xaxis->title->Set('X-title');
		$graph->yaxis->title->Set('Y-title');

		//$graph->title->SetFont(FF_FONT1,FS_BOLD);
		//$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
		//$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

		// Display the graph
		//$graph->Stroke();
		$graph->StrokeStore(public_path()."/store/bar-chart.png");

		return '<img src="/store/bar-chart.png?v='.md5(microtime()).'"/>';
	});

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
		Route::post('/properties/{properties}/republish', ['as' => 'properties.republish', 'uses' => 'PropertyController@republish']);
		Route::post('/properties/{properties}/delete', ['as' => 'properties.delete', 'uses' => 'PropertyController@delete']);
		Route::resource('/properties', 'PropertyController');

		Route::get('/profile', ['as' => 'profile.show', 'uses' => 'ProfileController@show']);
		Route::get('/profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
		Route::post('/profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
		Route::post('/profile/delete', ['as' => 'profile.delete', 'uses' => 'ProfileController@delete']);
	});



	Route::group(['before' => '', 'prefix' => 'api'], function(){
		Route::get('/property-search', 'ApiController@propertySearch');
		Route::get('/property', 'ApiController@property');
    	Route::get('/definitions', 'ApiController@definitions');
    	Route::get('/send-message', 'ApiController@sendMessage');
    	Route::post('/send-message', 'ApiController@sendMessage');
    	Route::get('/average-price-by-neighborhood', 'ApiController@priceByNeighborhood');
	});
});


App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');
