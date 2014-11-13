<?php
namespace Mileen\Api;


use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;

/**
*
*/
class AdService extends MileenApi
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Retorna el listado de parametros requeridos del servicio
	 *
	 * @return Array
	 */
	public function getRequiredParameters()
	{
		return Array();
	}

	/**
	 * Calcula el promedio de precio por metro cuadrado y genera el grafico
	 *
	 * @param  array $parameters
	 * @return string
	 */
	public function execute($parameters){
		try {
			$this->assertParameters($parameters);
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (IllegalArgumentException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (\Exception $e) {
			return $this->buildErrorResponse($e->getMessage());
		}

		$fields = ['id', 'title', 'description', 'target_url', 'banner'];

		$payload = [
			'ad' => \Ad::orderByRaw("RAND()")->select($fields)->first()->toArray()
		];

		return $this->buildResponse($payload);
	}
}

?>