<?php
namespace Mileen\Support;

/**
* Funciones varias para trabajar con arrays
*/
class ArrayHelper
{
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