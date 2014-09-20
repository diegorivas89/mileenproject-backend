<?php

/**
*
*/
class ApiController extends BaseController
{

	public function propertySearch()
	{
		return App::make('property-search-service')->execute(Input::all());
	}

	public function property()
	{
		return App::make('property-service')->execute(Input::all());
	}
}

?>