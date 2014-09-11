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
		$properties = $this->repository->userProperties(User::all()->first()->id);
    return View::make("property.index")->with('properties', $properties);
	}

	public function create()
	{
		return View::make("property.new");
	}
}

?>
