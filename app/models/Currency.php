<?php

/**
*
*/
class Currency extends MileenModel
{
	/**
	 * Convierte el valor pasado por parametro en la moneda indicada a dolares
	 *
	 * @param float $value
	 * @param string $from
	 * @return float
	 */
	public static function convert($value, $from = '$')
	{
		$currency = self::find($from);

		return round($value * $currency->value, 2);
	}
}

?>