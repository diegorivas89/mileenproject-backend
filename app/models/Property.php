<?php

/**
*
*/
class Property extends MileenModel
{
	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'title' => 'string',
			'price' => 'int',
			'currency' => 'string',
			'address' => 'string',
			'size' => 'int',
			'covered_size' => 'int',
			'environment_id' => 'int',
			'publication_type_id' => 'int',
		);
	}

	
}

?>