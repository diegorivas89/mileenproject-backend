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
class DefinitionsService extends MileenApi
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
  function __construct()
  {
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
    /**
     * Itero cada modelo y cambio los nombres de los atributos
     * y levanto el environment
     */

    $environments = \Environment::select("id", "name")->get();
    $neighborhoods = \Neighborhood::select("id", "name")->get();
    $propertyTypes = \PropertyType::select("id", "name")->get();
    $operationTypes = \OperationType::select("id", "name")->get();
    $amenitieTypes = \AmenitieType::select("id", "name")->get();
    $dateRanges = \DateRange::select("id", "name")->get();
    $currencies = \Currency::select("id")->get();
    $sizes = \Size::select('id', 'name')->get();

    $response = Array(
      'neighborhoods' => $neighborhoods->toArray(),
      'environments' => $environments->toArray(),
      'propertyTypes' => $propertyTypes->toArray(),
      'operationTypes' => $operationTypes->toArray(),
      'amenitieTypes' => $amenitieTypes->toArray(),
      'dateRanges' => $dateRanges->toArray(),
      'currencies' => $currencies->toArray(),
      'sizes' => $sizes->toArray(),
    );

    return $this->buildResponse($response);
  }

}

?>
