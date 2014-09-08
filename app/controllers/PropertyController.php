<?php

use \Mileen\Properties\PropertyRepositoryInterface;

/**
*
*/
class PropertyController extends BaseController
{

	protected $repository;

	function __construct(PropertyRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function index()
	{
		return $this->repository->find(1);
	}

	public function create()
	{
		return View::make("property.new");
	}
}

?>