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
		return Array('neighborhood', 'width', 'height', 'currency');
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

		$chartData = $this->generateChartData($neighborhood, $parameters['currency'], $operation);

		if (count($chartData) == 0){
			return $this->buildErrorResponse('No hay suficiente información para generar el gráfico');
		}

		$filename = $this->createChart($chartData, $parameters['currency'], $parameters['width'], $parameters['height']);

		$payload = [
			'url' => $filename,
			'neighborhood' => [
				'id' => $neighborhood->id,
				'name' => $neighborhood->name,
				'priceByM2' => $neighborhood->getPriceByM2($parameters['currency'], $operation)
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
	public function generateChartData($neighborhood, $currency, $operation = null)
	{
		$data = [];
		foreach ($neighborhood->getAdjacents() as $adjacentNeighborhood){
			$averagePrice = $adjacentNeighborhood->getPriceByM2($currency, $operation);
			if ($averagePrice > 0){
				$data[$adjacentNeighborhood->name] = $adjacentNeighborhood->getPriceByM2($currency, $operation);
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
	public function createChart($data, $currency, $width, $height)
	{
		$filename = \App::make('bar-chart')
						->setTitle('Precio promedio por M2', 'Barrios', ''/*$currency*/)
						->setData($data)
						->plot($width, $height);

		return $filename;
	}
}

?>