<?php

App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');
App::bind('\Mileen\Images\ImagesRepositoryInterface', '\Mileen\Images\ImagesRepository');
App::bind('\Mileen\Environments\EnvironmentRepositoryInterface', '\Mileen\Environments\EnvironmentRepository');

App::singleton('property-search-service', function() {
	$propRepository = new \Mileen\Properties\PropertyRepository(new Property());

	return new \Mileen\Api\PropertySearchService($propRepository);
});

App::singleton('property-service', function() {
	$propRepository = new \Mileen\Properties\PropertyRepository(new Property());

	return new \Mileen\Api\PropertyService($propRepository);
});

App::singleton('definitions-service', function() {
  return new \Mileen\Api\DefinitionsService();
});

App::singleton('send-message-service', function() {
  return new \Mileen\Api\SendMessageService();
});

App::singleton('price-by-neighborhood-service', function() {
  return new \Mileen\Api\PriceByNeighborhoodService();
});

App::singleton('property-by-environment-service', function() {
	return new \Mileen\Api\PropertyByEnvironmentService();
});

App::singleton('neighborhood-price-service', function() {
	return new \Mileen\Api\NeighborhoodPriceService();
});

App::singleton('retrieve-ad-service', function() {
	return new \Mileen\Api\AdService();
});

App::singleton('logged-user', function(){
	$user = Auth::user();

	return $user;
});

App::singleton('bar-chart', function(){
	return new \Mileen\Charts\Bar();
});

App::singleton('pie-chart', function(){
	return new \Mileen\Charts\Pie();
});
?>
