<?php
App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');


App::bind('\Mileen\Properties\PropertyRepositoryInterface', '\Mileen\Properties\PropertyRepository');
App::bind('\Mileen\Environments\EnvironmentRepositoryInterface', '\Mileen\Environments\EnvironmentRepository');

App::singleton('property-search-service', function(){
	$propRepository = new \Mileen\Properties\PropertyRepository(new Property());
	$envRepository = new \Mileen\Environments\EnvironmentRepository(new Environment());

	return new \Mileen\Api\PropertySearchService($propRepository, $envRepository);
});

?>
