<?php
namespace Mileen\Support;

/**
* Funciones varias para trabajar con arrays
*/
class ArrayHelper
{
	/**
	 * Cambia las claves de un array recursivamente de snake_case a camelCase
	 * Utiliza la funcion de laravel camel_case() para hacerlo
	 *
	 * @param  array $array
	 * @return array
	 */
	public static function keysToCamelCase($array)
	{
		$newArray = Array();
		foreach ($array as $key => $value){
			if (is_array($value)){
				$newArray[camel_case($key)] = self::keysToCamelCase($value);
			}else{
				$newArray[camel_case($key)] = $value;
			}
		}

		return $newArray;
	}
}
?>