<?php

/**
*
*/
class Adjacent extends MileenModel
{

	public $timestamps = false;

	public $fillable = ['neighborhood_id',
                        'adjacent_neighborhood_id'];

	function __construct()
	{
		
	}
}

?>