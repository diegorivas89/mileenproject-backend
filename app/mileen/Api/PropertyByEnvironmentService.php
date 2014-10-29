<?php
namespace Mileen\Api;

use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;
/**
*
*/
class PropertyByEnvironmentService extends MileenApi
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
				'name' => $neighborhood->name
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
		foreach ($neighborhood->getProperties() as $property){
			if (array_key_exists($property->environment_id, $data)){
				$data[$property->environment_id] += 1;
			}else{
				$data[$property->environment_id] = 1;
			}
		}

		$total = $neighborhood->getProperties()->count();

		foreach ($data as $key => $value){
			$data[$key] = ($data[$key] / $total) * 100;
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
		$filename = \App::make('pie-chart')
						->setTitle('Propiedades por ambientes')
						->setData($data)
						->plot($width, $height);

		return $filename;
	}
}


?>