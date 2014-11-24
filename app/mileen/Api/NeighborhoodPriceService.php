<?php
namespace Mileen\Api;


use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;

/**
*
*/
class NeighborhoodPriceService extends MileenApi
{
	const USD = 'U$S';
	const ARG = '$';

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

		if (array_key_exists('operation', $parameters)){
			$operation = $parameters['operation'];
		}else{
			$operation = null;
		}

		if ($neighborhood->getPriceByM2('$', $operation) == 0){
			return $this->buildErrorResponse('Insufficient data');
		}

		$payload = [
			'neighborhood' => [
				'id' => $neighborhood->id,
				'name' => $neighborhood->name
			],
			'prices' => [
				self::ARG => $neighborhood->getPriceByM2(self::ARG, $operation),
				self::USD => $neighborhood->getPriceByM2(self::USD, $operation)
			]
		];

		return $this->buildResponse($payload);
	}
}

 ?>