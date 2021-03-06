<?php

use \Mileen\Properties\PropertyRepositoryInterface;
use \Intervention\Image\ImageManagerStatic as ImageManager;
use \Mileen\Support\YoutubeUrl;
use \Mileen\Support\VimeoUrl;
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
		$properties = $this->repository->userProperties(Auth::user()->id);
		$activeProperties = $this->repository->userActiveProperties(Auth::user()->id);
	  return View::make("property.index")->with('properties', $properties)
	  																	 ->with('activeProperties', $activeProperties);
	}

	public function create()
	{
		$environments = Environment::all();
		$neighborhoods = Neighborhood::all();
		$operationTypes = OperationType::all();
		$propertyTypes = PropertyType::orderBy('name', 'asc')->get();
		$publicationTypes = PublicationType::all();
		$amenitieTypes = AmenitieType::orderBy('name', 'asc')->get();
		$propertyTypeFree = PublicationType::$free_value;

		return View::make("property.new")
					->with('propertyTypeFree', $propertyTypeFree)
					->with('environments', $environments)
					->with('neighborhoods', $neighborhoods)
					->with('operationTypes', $operationTypes)
					->with('propertyTypes', $propertyTypes)
					->with('publicationTypes', $publicationTypes)
					->with('amenitieTypes', $amenitieTypes);
	}

	public function store()
	{

		//si el usuario no le puso http o https se lo agrego.
		$video_url = Input::get('video_url');
		if(isset($video_url) && $video_url && !(strstr( $video_url, 'http://') || strstr( $video_url, 'https://'))){
    		Input::merge(array('video_url'=>"http://".$video_url));
		}

		if (Input::has('expiration_date')){
			$expiration_date = Input::get('expiration_date');
		    $date = preg_replace('/\s+/', '', $expiration_date);
		    $date = "31/{$date}";
		    $date = DateTime::createFromFormat('d/m/Y', $date);
		    Input::merge(array('expiration_date' => $date->format('Y-m-d')));
		}

		Input::merge(array('user_id' => Auth::user()->id));

		$validator = Validator::make(Input::all(), Property::getValidationRules());
		$invalid_covered_size = Input::get('covered_size') > Input::get('size');

		$validVideoUrl = true;
		if(Input::has('video_url')) {
			$validVideoUrl = \Mileen\Support\YoutubeUrl::test(Input::get('video_url'));
		}

		if ($validator->fails() || $invalid_covered_size || !$validVideoUrl)
		{
			if($invalid_covered_size) {
				$validator->errors()->add('covered_size', Lang::get('validation.covered_size'));
			}

			if(!$validVideoUrl) {
				$validator->errors()->add('video_url', Lang::get('validation.video_url'));
			}

			return Redirect::route('properties.create')->withInput()->withErrors($validator);
		}else{
			//guardo la propiedad
			$property = Property::create(Input::except('amenitieType'));
			//guardo las amenities
			AmenitieProperty::storeAmenitiesForProperty($property->id, Input::get('amenitieType'));
			//guardo las imagenes
			$this->storeImages($property, Input::file('images'));

			return Redirect::route('properties.index');
		}
	}

	public function storeImages($property, $images)
	{
		foreach ($images as $image) {
			if (isset($image) && exif_imagetype($image->getRealPath())){
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

	public function show($id)
	{
		$property = Property::find($id);
		if((empty($property) || $property->user_id != Auth::user()->id)) {
			return Redirect::to('properties');
		}
		$property = $this->repository->find($id);
		$amenities = $this->repository->getAmenities($id);
		$images = $this->repository->getImages($id);
		if (YoutubeUrl::test($property->video_url)) {
			$youtube = YoutubeUrl::create($property->video_url);
			$video = Array(
				'url' 		=> $youtube->getUrl(),
				'embed_url' => $youtube->getEmbedUrl(),
				'thumbnail' => $youtube->getThumbnailUrl()
			);
		}elseif (VimeoUrl::test($property->video_url)) {
			$vimeo = VimeoUrl::create($property->video_url);
			$video = Array(
				'url' 		=> $vimeo->getUrl(),
				'embed_url' => $vimeo->getEmbedUrl(),
				'thumbnail' => $vimeo->getThumbnailUrl()
			);
		}else{
			$video = Array(
				'url' 		=> '',
				'embed_url' => '',
				'thumbnail' => ''
			);
		}
	  return View::make("property.show")->with('property', $property)
	  																  ->with('amenities', $amenities)
	  																  ->with('images', $images)
	  																  ->with('video', $video);
	}

	public function pause($id)
	{
		$property = Property::find($id);
		$property->state = Property::paused;
		$property->save();
		return Redirect::to("properties/{$id}")->with('message', 'La propiedad está en pausa.');
	}

	public function reactivate($id)
	{
		$property = Property::find($id);
		$property->state = Property::active;
		$property->save();
		return Redirect::to("properties/{$id}")->with('message', 'La propiedad se reactivó.');

	}

	public function payRepublish($id){
		$property = Property::find($id);
		$publicationType = PublicationType::find($property->publication_type_id);
		$price = ($property->daysUntilExpiry() <= 30 && $property->daysUntilExpiry() > 0) ? floatval(1 - $publicationType->discount) : 1;
		$price *= $publicationType->price;
		$price = round($price, 0, PHP_ROUND_HALF_UP);
		$action = (empty($_POST['action'])) ? 'default' : $_POST['action'];
	  	return View::make("property.payrepublish")
								  ->with('property', $property)
								  ->with('price', $price)
								  ->with('regularPrice', $publicationType->price)
								  ->with('publicationType', $publicationType);
	}

	public function republish($id)
	{
		$property = Property::find($id);
		$publicationType = PublicationType::find($property->publication_type_id);
		if(	$publicationType->value == PublicationType::$free_value){
			$property->state = Property::active;
			$property->republished = true;
			//$property->created_at = $property->created_at->addDays($publicationType->validity_period);
			$property->created_at = \Carbon\Carbon::now();
			$property->save();
			return Redirect::to("properties/{$id}")->with('message', 'La propiedad se republicó.');
		}

		return Redirect::to("properties/{$id}/payrepublish");
 	}

	public function savePayrepublish($id){
 		$property = Property::find($id);
 		$publicationType = PublicationType::find($property->publication_type_id);
		if($property->republished){
			return Redirect::to("properties/{$id}")->with('message', 'Esta publicación no puede ser republicada ya que ya fue republicada anteriormente.');
		}
 		$property->state = Property::active;
 		$property->republished = true;
 		//$property->created_at = $property->created_at->addDays($publicationType->validity_period);
 		$property->created_at = \Carbon\Carbon::now();
		$property->credit_card_number = Input::get('credit_card_number');
		$property->security_code = Input::get('security_code');
		$property->card_owner = Input::get('card_owner');
		$property->expiration_date = Input::get('expiration_date');
 		$property->save();
		return Redirect::to("properties/{$id}")->with('message', 'La propiedad se republicó.');
	}

	public function delete($id)
	{
		$property = Property::find($id);
		$property->state = Property::deleted;
		$property->save();
		return Redirect::to("properties")->with('message', 'La propiedad se ha borrado exitosamente.');
	}

	public function edit($id)
	{
		return View::make('property.edit')->with('property', Property::find($id));
	}

	public function update($id)
	{
		$rules = [
			'price' => Property::getValidationRules('price'),
			'expenses' => Property::getValidationRules('expenses'),
			'currency' => Property::getValidationRules('currency')
		];

		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails())
		{
			return Redirect::route('properties.edit', $id)->withInput()->withErrors($validator);
		}else{
			$property = Property::find($id);
			$property->currency = Input::get('currency');
			$property->price = Input::get('price');
			$property->expenses = Input::get('expenses');
			$property->save();

			return Redirect::route('properties.show', $id);
		}
	}

}

?>
