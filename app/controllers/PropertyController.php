<?php

use \Mileen\Properties\PropertyRepositoryInterface;
use \Intervention\Image\ImageManagerStatic as ImageManager;
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

			$this->storeImages($property, Input::file('images'));

			return Redirect::route('properties.index')	;
		}
	}

	public function storeImages($property, $images)
	{
		foreach ($images as $image) {
			if (isset($image)){
				$name = md5(microtime(true).rand(1,9999));

				$imageModel = new Image();
				$imageModel->property_id = $property->id;
				$imageModel->name = $name;
				$imageModel->save();

				$destPath = public_path().'/store/images/'.$name;

				foreach (Array(100, 300, 600, 1200) as $width) {
					// and you are ready to go ...
					ImageManager::make($image->getRealPath())
								->widen($width)
								->save($destPath.'_'.$width);
				}

				$image->move(public_path().'/store/images/', $name);
			}
		}
	}
}

?>
