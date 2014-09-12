<?php

/**
* Modelo de la tabla images
*/
class Image extends MileenModel
{
	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'name' => 'string',
		);
	}
}

?>