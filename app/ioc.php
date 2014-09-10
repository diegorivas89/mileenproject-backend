<?php

App::singleton('property-search-service', function(){
	$api = new \Mileen\Api\PropertySearchService(new \Mileen\Properties\PropertyRepository(new Property()));

	return $api;
});

?>