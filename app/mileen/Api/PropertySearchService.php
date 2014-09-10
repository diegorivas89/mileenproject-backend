<?php
namespace Mileen\Api;

/**
* Busca una propiedad por id
*/
class PropertySearchService extends MileenApi
{
	protected $repository;

	function __construct(\Mileen\Properties\PropertyRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function getRequiredParameters()
	{
		return Array();
	}

	public function execute($parameters)
	{
		try {
			$this->assertParameters($parameters);
			return $this->buildResponse($this->repository->search($parameters));
		} catch (\Exception $e) {
			return $this->buildErrorResponse($e->getMessage());
		}
	}
}

?>