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
		$environments = Environment::all();
		$neighborhoods = Neighborhood::all();
		$operationTypes = OperationType::all();
		$propertyTypes = PropertyType::all();
		$publicationTypes = PublicationType::all();
		$amenitieTypes = AmenitieType::all();

		return View::make("property.new")
					->with('environments', $environments)
					->with('neighborhoods', $neighborhoods)
					->with('operationTypes', $operationTypes)
					->with('propertyTypes', $propertyTypes)
					->with('publicationTypes', $publicationTypes)
					->with('amenitieTypes', $amenitieTypes);
	}

	public function store()
	{
		$validator = Validator::make(Input::all(), Property::getValidationRules());

		if ($validator->fails())
		{
			return Redirect::route('properties.create')->withInput()->withErrors($validator);
		}else{
			//guardar
			$property = Property::create(Input::all());

			return Redirect::route('properties.index')	;
		}
	}
}

?>
