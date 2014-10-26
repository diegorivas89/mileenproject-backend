<?php
namespace Mileen\Api;

use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;

/**
*
*/
class PriceByNeighborhoodService extends MileenApi
{

	function __construct()
	{
		
	}

	/**
	 * Retorna el listado de parametros requeridos del servicio
	 *
	 * @return Array
	 */
	public function getRequiredParameters()
	{
		return Array('neighborhood', 'width', 'height');
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

		$data = [];
		foreach ($neighborhood->getAdjacents() as $adjacentNeighborhood){
			$data[$adjacentNeighborhood->name] = $adjacentNeighborhood->getPriceByM2();
		}

		$filename = \App::make('bar-chart')
						->setTitle('Precio promedio por M2', 'Barrios', '$')
						->setData($data)
						->plot(600, 400);

		echo $filename;die();
	}
}

?>