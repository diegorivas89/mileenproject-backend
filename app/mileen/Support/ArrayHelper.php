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

	public static function encode($value){
        $value = trim($value);

        if (strlen($value) > 0) {
            $newvalue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            if (strlen($newvalue) > 0) {
                $value = $newvalue;
            } else {
                $value = htmlspecialchars($value, ENT_QUOTES, 'ISO-8859-1');
            }
        }

        return $value;
    }

    public static function decode($value){
        return htmlspecialchars_decode($value, ENT_QUOTES);
    }

    public static function encodeArray($array){
        $sanitized = Array();
        foreach ($array as $key => $value){
            if (is_array($value)){
                $sanitized[$key] = self::encodeArray($value);
            }else{
                $sanitized[$key] = self::encode($value);
            }
        }

        return $sanitized;
    }
}
?>