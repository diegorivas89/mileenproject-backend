<?php
namespace Mileen\Api;

use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;
use \Mileen\Properties\PropertyRepositoryInterface;
use \Mileen\Environments\EnvironmentRepositoryInterface;
use \Mileen\Images\ImageRepositoryInterface;
use \Mileen\Support\YoutubeUrl;

/**
* Servicio para buscar una propiedad por id
*/
class PropertySearchService extends MileenApi
{
	/**
	 * Repositorio de propiedades
	 * @var \Mileen\Properties\PropertyRepositoryInterface
	 */
	protected $repository;

	/**
	 * Constructor de clase
	 *
	 * @param MileenPropertiesPropertyRepositoryInterface $repository
	 */
	function __construct(PropertyRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Retorna el listado de parametros requeridos del servicio
	 *
	 * @return Array
	 */
	public function getRequiredParameters()
	{
		return Array();
	}

	/**
	 * chequea los parametros requeridos y ejecuta el servicio retornando el response
	 *
	 * @param array $parameters
	 * @return string
	 */
	public function execute($parameters)
	{
		try {
			$this->assertParameters($parameters);
			$properties = $this->repository->search($parameters);
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		}  catch (IllegalArgumentException $e) {
			return $this->buildErrorResponse($e->getMessage());
		}


		/**
		 * Itero cada modelo y cambio los nombres de los atributos
		 * y levanto el environment
		 */
		$properties->each(function($property){
			$property->environment = $property->getEnvironment(['id', 'name']);
			unset($property->environment_id);

			$property->priority = intval($property->publication_type_id);
			unset($property->publication_type_id);

			$pictures = Array();

			foreach ($property->getImages() as $image) {
				$pictures[] = $image->getUrl();
			}

			$property->pictures = $pictures;

			$youtube = YoutubeUrl::create($property->video_url);
			$video = Array(
				'url' => $youtube->getUrl(),
				'embed_url' => $youtube->getEmbedUrl(),
				'thumbnail' => $youtube->getThumbnailUrl()
			);
			$property->video = $video;
			unset($property->video_url);
		});

		return $this->buildResponse($properties);
	}
}

?>