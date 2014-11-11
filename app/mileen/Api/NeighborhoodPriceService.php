<?php
namespace Mileen\Api;


use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;

/**
*
*/
class NeighborhoodPriceService extends MileenApi
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
		return Array('neighborhood');
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

			$neighborhood = \Neighborhood::findOrFail($parameters['neighborhood']);
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (IllegalArgumentException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (\Exception $e) {
			return $this->buildErrorResponse($e->getMessage());
		}

		if ($neighborhood->getPriceByM2('$') == 0){
			return $this->buildErrorResponse('Insufficient data');
		}

		$payload = [
			'neighborhood' => [
				'id' => $neighborhood->id,
				'name' => $neighborhood->name
			],
			'prices' => [
				'$' => $neighborhood->getPriceByM2('$'),
				'U$S' => $neighborhood->getPriceByM2('U$S')
			]
		];

		return $this->buildResponse($payload);
	}
}

 ?>