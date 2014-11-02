<?php

/**
*
*/
class PublicationType extends MileenModel
{

	public static $premium_value = 3;
	public static $basic_value = 3;
	public static $free_value = 3;
	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'name' => 'string',
		);
	}
}

?>
