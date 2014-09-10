<?php
namespace Mileen\Api;
/**
*
*/
abstract class MileenApi
{

	function __construct()
	{
		$this->requiredParameters = Array();
	}

	/**
	 * Ejecuta el servicio y retorna el response correspondiente
	 *
	 * @return strin|json
	 */
	public abstract function execute($parameters);

	/**
	 * Retorna el listado de parametros requeridos del servicio
	 *
	 * @return Array
	 */
	public abstract function getRequiredParameters();

	/**
	 * Chequea que esten los parametros requeridos
	 *
	 * @param Array $parameters
	 * @throws \Exception
	 * @return void
	 */
	protected function assertParameters($parameters = Array())
	{
		foreach ($this->getRequiredParameters() as $parameter) {
			if (!array_key_exists($parameter, $parameters)){
				throw new \Exception("required parameter: ".$parameter." missing!", 1);
			}
		}
	}

	/**
	 * Genera la respuesta cuando no hay errores
	 *
	 * @param  Array $payload
	 * @return string
	 */
	public function buildResponse($payload = Array())
	{
		$response = Array(
			'error' => 0,
			'message' => "ok",
			'payload' => $payload
		);

		return json_encode($response);
	}

	/**
	 * Genera la respuesta cuando hay errores
	 *
	 * @param  Array $payload
	 * @return string
	 */
	public function buildErrorResponse($message)
	{
		$response = Array(
			'error' => 1,
			'message' => $message,
			'payload' => Array()
		);

		return json_encode($response);
	}
}

?>