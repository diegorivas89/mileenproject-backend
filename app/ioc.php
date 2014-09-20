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

App::singleton('logged-user', function(){
	$user = Auth::user();

	return $user;
});
?>
