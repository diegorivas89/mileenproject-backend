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
		return "adasdasd";
	}

	public function create()
	{
		return View::make("property.new");
	}

	public function store()
	{
		$messages = array(
			'required' => 'El campo :attribute es requerido.',
			'numeric' => 'El campo :attribute debe ser numerico.'
		);

		$rules = array(
			'title' => array('required', 'min:5'),
			'description' => array('required', 'min:5'),
			'user_id' => array('required','numeric'),
			'property_type_id' => array('required','numeric'),
			'environment_id' => array('required','numeric' ),
			'address' => array('required' ),
			'latitude' => array('required','numeric' ),
			'longitude' => array('required','numeric' ),
			'currency' => array('required','numeric' ),
			'price' => array('required','numeric' ),
			'expenses' => array('required','numeric' ),
			'age' => array('required','numeric' ,'min:5')
		);	
		$validator = Validator::make(Input::all(), $rules, $messages);
		$niceNames = array(
		);

		$validator->setAttributeNames($niceNames); 
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

