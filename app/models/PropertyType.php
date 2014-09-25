<?php

/**
*
*/
class PropertyType extends MileenModel
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
