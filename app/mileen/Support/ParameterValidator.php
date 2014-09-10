<?php
namespace Mileen\Support;

use Mileen\Support\Exceptions\IllegalArgumentException;

/**
* Funciones varias para trabajar con arrays
*/
class ParameterValidator
{
	/**
	 * Valida que si existe un valor bajo la clave $name en $parameters sea de tipo numerico. En caso 
	 * de no existir retorna false, si existe y no es numerico levante una exception, retorna true
	 * en otro caso
	 *
	 * @param  string $name
	 * @param  array $parameters
	 * @return array
	 */
	public static function integer($name, $parameters)
	{
		if (array_key_exists($name, $parameters)){
			if (is_numeric($parameters[$name])){
				return true;
			}else{
				throw new IllegalArgumentException("The parameter '".$name."' must be of type integer", 1);
			}
		}else{
			return false;
		}
	}

	/**
	 * Valida que si existe un valor bajo la clave $name en $parameters sea de tipo lista nuemrica separada por comas. 
	 * En caso de no existir retorna false, si existe y no es una lista valida levanta una exception, retorna true
	 * en otro caso
	 *
	 * @param  string $name
	 * @param  array $parameters
	 * @return array
	 */
	public static function _list($name, $parameters)
	{
		if (array_key_exists($name, $parameters)){
			if (preg_match('/[0-9\,]+/si', $parameters[$name])){
				return true;
			}else{
				throw new IllegalArgumentException("The parameter '".$name."' must be of type integer separated by commas.", 1);
			}
		}else{
			return false;
		}
	}

	/**
	 * Valida que si existe un valor bajo la clave $name en $parameters sea de tipo fecha. En caso 
	 * de no existir retorna false, si existe y no es fecha levante una exception, retorna true
	 * en otro caso
	 *
	 * @param  string $name
	 * @param  array $parameters
	 * @return array
	 */
	public static function date($name, $parameters)
	{
		if (array_key_exists($name, $parameters)){
			if (preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/si', $parameters[$name])){
				return true;
			}else{
				throw new IllegalArgumentException("The parameter '".$name."' must be of type date: YYYY-mm-dd.", 1);
			}
		}else{
			return false;
		}
	}
}
?>