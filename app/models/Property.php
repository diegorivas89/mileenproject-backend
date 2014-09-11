<?php

/**
*
*/
class Property extends MileenModel
{

	protected $fillable = array(
		"title",
		"description",
		"age",
		"user_id",
		"property_type_id",
		"environment_id",
		"title",
		"description",
		"address",
		"latitude",
		"longitude",
		"currency",
		"price",
		"expenses",
		"age"
	);

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
