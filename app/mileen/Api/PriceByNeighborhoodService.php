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

		$chartData = $this->generateChartData($neighborhood);

		if (count($chartData) == 0){
			return $this->buildErrorResponse('Insufficient data to plot the chart');
		}

		$filename = $this->createChart($chartData, $parameters['width'], $parameters['height']);

		$payload = [
			'url' => $filename,
			'neighborhood' => [
				'id' => $neighborhood->id,
				'name' => $neighborhood->name,
				'priceByM2' => $neighborhood->getPriceByM2()
			],
			'data' => $chartData
		];

		return $this->buildResponse($payload);
	}

	/**
	 * Genera la data para poder graficar
	 *
	 * @param  \Neighborhood $neighborhood
	 * @return array
	 */
	public function generateChartData($neighborhood)
	{
		$data = [];
		foreach ($neighborhood->getAdjacents() as $adjacentNeighborhood){
			$averagePrice = $adjacentNeighborhood->getPriceByM2();
			if ($averagePrice > 0){
				$data[$adjacentNeighborhood->name] = $adjacentNeighborhood->getPriceByM2();
			}
		}

		return $data;
	}

	/**
	 * Crea el grafico y lo guarda en un archivo, retorna la ruta a este
	 *
	 * @param  \Neighborhood $neighborhood
	 * @return string
	 */
	public function createChart($data, $width, $height)
	{
		$filename = \App::make('bar-chart')
						->setTitle('Precio promedio por M2', 'Barrios', '$')
						->setData($data)
						->plot($width, $height);

		return $filename;
	}
}

?>