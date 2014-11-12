<?php

/**
*
*/
class ApiController extends BaseController
{

	public function propertySearch()
	{
		return $this->makeResponse(App::make('property-search-service')->run(Input::all()));
	}

	public function property()
	{
		return $this->makeResponse(App::make('property-service')->run(Input::all()));
	}

	public function definitions()
	{
		return $this->makeResponse(App::make('definitions-service')->run(Input::all()));
	}

	public function sendMessage()
	{
		return $this->makeResponse(App::make('send-message-service')->run(Input::all()));
	}

	public function priceByNeighborhood()
	{
		return $this->makeResponse(App::make('price-by-neighborhood-service')->run(Input::all()));
	}

	public function neighborhoodPrice()
	{
		return $this->makeResponse(App::make('neighborhood-price-service')->run(Input::all()));
	}

	public function propertiesByEnvironments()
	{
		return $this->makeResponse(App::make('property-by-environment-service')->run(Input::all()));
	}

	public function retrieveAd()
	{
		return $this->makeResponse(App::make('retrieve-ad-service')->run(Input::all()));
	}

	private function makeResponse($content)
	{
		$response = Response::make($content, 200);
		$response->header('Content-Type', 'application/json');//
		$response->setCharset('UTF-8');

		return $response;
	}
}

?>
