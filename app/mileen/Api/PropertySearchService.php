<?php
namespace Mileen\Api;

use Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Properties\PropertyRepositoryInterface;
use \Mileen\Environments\EnvironmentRepositoryInterface;

/**
* Servicio para buscar una propiedad por id
*/
class PropertySearchService extends MileenApi
{
	/**
	 * Repositorio de propiedades
	 * @var \Mileen\Properties\PropertyRepositoryInterface
	 */
	protected $repository;

	protected $environmentRepository;

	/**
	 * Constructor de clase
	 *
	 * @param MileenPropertiesPropertyRepositoryInterface $repository
	 */
	function __construct(PropertyRepositoryInterface $repository, EnvironmentRepositoryInterface $environmentRepository)
	{
		$this->repository = $repository;
		$this->environmentRepository = $environmentRepository;
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
	 * chequea los parametros requeridos y ejecuta el servicio retornando el response
	 *
	 * @param array $parameters
	 * @return string
	 */
	public function execute($parameters)
	{
		try {
			$this->assertParameters($parameters);
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		}

		$properties = $this->repository->search($parameters);

		/**
		 * Itero cada modelo y cambio los nombres de los atributos y levanto el environment
		 */
		$properties->each(function($property){
			$environment = $this->environmentRepository->find($property->environment_id);
			$property->environment = $environment;
			unset($property->environment_id);

			$property->priority = $property->operation_type_id;
			unset($property->operation_type_id);
		});

		return $this->buildResponse($properties);
	}
}

?>