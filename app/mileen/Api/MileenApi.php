<?php
namespace Mileen\Api;
/**
*
*/
class MileenApi
{
	protected $propertyRepository;

	function __construct()
	{
	}

	public function setPropertyRepository(\Mileen\Properties\PropertyRepositoryInterface $repository)
	{
		$this->propertyRepository = $repository;
	}

	public function property($parameters)
	{
		return $this->propertyRepository->find($parameters['id']);
	}

	public function propertySearch($parameters)
	{
		return $this->propertyRepository->search($parameters);
	}
}

?>