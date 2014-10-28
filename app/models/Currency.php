<?php

/**
*
*/
class Currency extends MileenModel
{
	public static convert($value, $from = '$')
	{
		$currency = self::find($from);

		return round($value * $currency->value, 2);
	}
}

?>