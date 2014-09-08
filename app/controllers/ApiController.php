<?php 

/**
* 
*/
class ApiController extends BaseController
{

	public function property()
	{
		return App::make('mileen-api')->property(Input::all());
	}

	public function propertySearch()
	{
		return App::make('mileen-api')->propertySearch(Input::all());
	}
}

?>