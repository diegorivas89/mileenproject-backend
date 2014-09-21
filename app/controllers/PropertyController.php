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
		$properties = $this->repository->userProperties(User::all()->first()->id);
	    return View::make("property.index")->with('properties', $properties);
	}

	public function create()
	{
		$environments = Environment::all();
		$neighborhoods = Neighborhood::all();
		$operationTypes = OperationType::all();
		$propertyTypes = PropertyType::orderBy('name', 'asc')->get();
		$publicationTypes = PublicationType::all();
		$amenitieTypes = AmenitieType::orderBy('name', 'asc')->get();

		return View::make("property.new")
					->with('environments', $environments)
					->with('neighborhoods', $neighborhoods)
					->with('operationTypes', $operationTypes)
					->with('propertyTypes', $propertyTypes)
					->with('publicationTypes', $publicationTypes)
					->with('amenitieTypes', $amenitieTypes);
	}

	public function store()
	{	//si el usuario no le puso http o https se lo agrego.
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

		$validator = Validator::make(Input::all(), Property::getValidationRules());

		if ($validator->fails())
		{
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

}

?>
