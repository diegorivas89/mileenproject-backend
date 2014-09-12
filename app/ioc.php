<?php

App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');
App::bind('\Mileen\Images\ImagesRepositoryInterface', '\Mileen\Images\ImagesRepository');
App::bind('\Mileen\Environments\EnvironmentRepositoryInterface', '\Mileen\Environments\EnvironmentRepository');

App::singleton('property-search-service', function(){
	$propRepository = new \Mileen\Properties\PropertyRepository(new Property());

	return new \Mileen\Api\PropertySearchService($propRepository);
});

?>
