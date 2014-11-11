<?php

/**
*
*/
class Ad extends MileenModel
{

	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'title' => 'string',
			'description' => 'description',
			'target_url' => 'string',
			'banner' => 'string',
		);
	}
}

?>