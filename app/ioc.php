<?php

App::singleton('mileen-api', function(){
	$api = new \Mileen\Api\MileenApi();
	$api->setPropertyRepository(new \Mileen\Properties\PropertyRepository(new Property()));
	return $api;
});

?>