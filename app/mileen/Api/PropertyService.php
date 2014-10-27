<?php
namespace Mileen\Api;

use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Mileen\Support\YoutubeUrl;
use \Mileen\Support\VimeoUrl;

/**
* Busca una propiedad por id
*/
class PropertyService extends MileenApi
{
	protected $repository;

	public function __construct(\Mileen\Properties\PropertyRepositoryInterface $repository)
	{
		parent::__construct();

		$this->repository = $repository;
	}

	public function getRequiredParameters()
	{
		return Array('id');
	}

	public function execute($parameters)
	{
		try {
			$this->assertParameters($parameters);
			$property = $this->repository->find($parameters['id']);
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (IllegalArgumentException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (ModelNotFoundException $e){
			return $this->buildErrorResponse($e->getMessage());
		}

		$pictures = Array();
		foreach ($property->getImages() as $image){
			$pictures[] = $image->getUrl();
		};

		$property->pictures = $pictures;

		$property->video = $this->getVideoResponse($property->video_url);
		unset($property->video_url);

		$property->environment = $property->getEnvironment();
		unset($property->environment_id);

		$property->propertyType = $property->getPropertyType();
		unset($property->property_type_id);

		$property->operationType = $property->getOperationType();
		unset($property->operation_type_id);

		$publicationType = $property->getPublicationType(['value']);
		$property->priority = intval($publicationType->value);

		$property->publicationType = $property->getPublicationType();
		unset($property->publication_type_id);

		$property->neighborhood = $property->getNeighborhood();
		unset($property->neighborhood_id);

		$amenities = \AmenitieProperty::select("amenitie_type_id")->where("property_id", $property->id)->get();
		$amenitiesName = Array();
		foreach ($amenities as $index => $value) {
			$amenitiesName[] = array('id' => $value->amenitie_type_id, 'name' => (\AmenitieType::find($value->amenitie_type_id)->name));
		}

		$property['amenitieType'] = $amenitiesName;

		$property->user = $property->getUser();
		unset($property->user_id);

		unset($property->credit_card_number);
		unset($property->security_code);
		unset($property->card_owner);
		unset($property->created_at);
		unset($property->updated_at);

		return $this->buildResponse($property->toArray());
	}

	/**
	 * Genera la respuesta del video para vimeo o youtube
	 *
	 * @param  string $url
	 * @return array
	 */
	private function getVideoResponse($url)
	{
		if (YoutubeUrl::test($url)){
			$youtube = YoutubeUrl::create($url);
			$video = Array(
				'id' 		=> $youtube->getVideoId(),
				'url' 		=> $youtube->getUrl(),
				'embed_url' => $youtube->getEmbedUrl(),
				'thumbnail' => $youtube->getThumbnailUrl()
			);
		}elseif (VimeoUrl::test($url)){
			$vimeo = VimeoUrl::create($url);
			$video = Array(
				'id' 		=> '',
				'url' 		=> $vimeo->getUrl(),
				'embed_url' => $vimeo->getEmbedUrl(),
				'thumbnail' => $vimeo->getThumbnailUrl()
			);
		}else{
			$video = Array(
				'id' 		=> '',
				'url' 		=> '',
				'embed_url' => '',
				'thumbnail' => ''
			);
		}

		return $video;
	}
}

?>
