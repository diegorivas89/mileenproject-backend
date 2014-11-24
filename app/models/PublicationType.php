<?php

/**
*
*/
class PublicationType extends MileenModel
{
	public static $premium_value = 1;
	public static $basic_value = 2;
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
