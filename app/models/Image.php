<?php

/**
* Modelo de la tabla images
*/
class Image extends MileenModel
{
	protected $fillable = array(
		"name",
	);

	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'name' => 'string',
		);
	}

	public function getUrl()
	{
		return $this->name;
	}
}

?>