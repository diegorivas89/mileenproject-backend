<?php

/**
*
*/
class Environment extends MileenModel
{
	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'name' => 'string',
		);
	}

	public function getIdAttribute($value = '')
	{
		return intval($value);
	}
}

?>