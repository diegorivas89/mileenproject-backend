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

	public function toArray()
	{
		$array = Array(
			'id' => $this->id,
			'name' => $this->name,
		);

		return $array;
	}
}

?>