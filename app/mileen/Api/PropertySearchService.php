<?php
namespace Mileen\Api;

use \Mileen\Api\Exceptions\MissingParamentersException;
use \Mileen\Support\Exceptions\IllegalArgumentException;
use \Mileen\Properties\PropertyRepositoryInterface;
use \Mileen\Environments\EnvironmentRepositoryInterface;
use \Mileen\Images\ImageRepositoryInterface;
use \Mileen\Support\YoutubeUrl;
use \Mileen\Support\VimeoUrl;
use Mileen\Support\ParameterValidator;

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
			$count = $this->repository->count($parameters);
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

			$publicationType = $property->getPublicationType(['value']);
			$property->priority = intval($publicationType->value);
			unset($property->publication_type_id);

			$pictures = Array();

			foreach ($property->getImages() as $image) {
				$pictures[] = $image->getUrl();
			}

			$property->pictures = $pictures;

			$property->video = $this->getVideoResponse($property->video_url);
			unset($property->video_url);
		});

		$response = Array(
			'publications' => $properties->toArray(),
			'count' => $count,
			'lastPageReached' => $this->lastPageReached($count, $parameters)
		);

		return $this->buildResponse($response);
	}

	/**
	 * Calcula si se ha alcanzado la ultima pagina
	 *
	 * @param  int $count
	 * @param  array $parameters
	 * @return bool
	 */
	private function lastPageReached($count, $parameters)
	{
		if (ParameterValidator::integer('amount', $parameters) && ParameterValidator::integer('offset', $parameters)){
			$tailPosition = $parameters['offset'] + $parameters['amount'];
			return ($tailPosition >= $count);
		}

		/**
		 * si no estan los parametros de amount y offset, se retorno la tabla entera,
		 * entonces ah llegado a la ultima pagina
		 */
		return true;
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
				'url' 		=> $youtube->getUrl(),
				'embed_url' => $youtube->getEmbedUrl(),
				'thumbnail' => $youtube->getThumbnailUrl()
			);
		}elseif (VimeoUrl::test($url)){
			$vimeo = VimeoUrl::create($url);
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

		return $video;
	}
}

?>