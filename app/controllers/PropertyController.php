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
// property_types oficina depto
// publication_types
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
		$rules = array(
			'title' => array('required', 'min:5'),
			'description' => array('required', 'min:5'),
			'user_id' => array('required','numeric'),
			'property_type_id' => array('required','numeric'),
			'publication_type_id' => array('required','numeric'),
			'environment_id' => array('required','numeric' ),
			'address' => array('required' ),
			'latitude' => array('required','numeric' ),
			'longitude' => array('required','numeric' ),
			'currency' => array('required','numeric' ),
			'price' => array('required','numeric' ),
			'expenses' => array('required','numeric' ),
			'age' => array('required','numeric' ,'min:5'),
			'size' => array('required','numeric' ,'min:2')
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::route('properties.create')->withErrors($validator);
			// The given data did not pass validation
		}else{
			//guardar
			$property = Property::create(Input::all());

			return Redirect::route('properties.index')	;
		}

	}
}

?>
