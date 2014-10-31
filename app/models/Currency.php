<?php

/**
*
*/
class Currency extends MileenModel
{
	public function getSchema()
	{
		return Array(
			'id' => 'string',
		);
	}

	/**
	 * Convierte el valor pasado por parametro en la moneda indicada a dolares
	 *
	 * @param float $value
	 * @param string $from
	 * @return float
	 */
	public static function convert($value, $from = '$', $to = 'U$S')
	{
		$currencyFrom = Currency::find($from);
		$currencyTo = Currency::find($to);

		$dollarValue = $value / $currencyFrom->value;

		$toValue = round($dollarValue * $currencyTo->value);

		return $toValue;
	}

	/**
	 * Convierte el valor pasado por parametro en la moneda indicada a dolares
	 *
	 * @param float $value
	 * @param string $from
	 * @return float
	 */
	public static function convertTo($value, $from = '$')
	{
		if ($from == '$'){
			return self::convert($value, $from, 'U$S');
		}else{
			return self::convert($value, $from, '$');
		}
	}

	public static function toggle($currency)
	{
		if ($currency == '$'){
			return 'U$S';
		}else{
			return '$';
		}
	}
}

?>