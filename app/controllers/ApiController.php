<?php

/**
*
*/
class ApiController extends BaseController
{

	public function propertySearch()
	{
		return $this->makeResponse(App::make('property-search-service')->execute(Input::all()));
	}

	public function property()
	{
		return $this->makeResponse(App::make('property-service')->execute(Input::all()));
	}

	public function definitions()
	{
		return $this->makeResponse(App::make('definitions-service')->execute(Input::all()));
	}

	public function sendMessage()
	{
		return $this->makeResponse(App::make('send-message-service')->execute(Input::all()));
		//return App::make('send-message-service')->execute(Input::all());
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
