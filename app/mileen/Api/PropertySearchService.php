<?php
namespace Mileen\Api;

use Mileen\Api\Exceptions\MissingParamentersException;

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

	/**
	 * Constructor de clase
	 *
	 * @param MileenPropertiesPropertyRepositoryInterface $repository
	 */
	function __construct(\Mileen\Properties\PropertyRepositoryInterface $repository)
	{
		$this->repository = $repository;
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
			return $this->buildResponse($this->repository->search($parameters));
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		}
	}
}

?>