<?php
namespace Mileen\Properties;

use Mileen\Support\ParameterValidator;

/**
* Repositorio para la tabla properties
*/
class PropertyRepository implements PropertyRepositoryInterface
{
	/**
	 * Modelo de Eloquent para la tabla properties
	 *
	 * @var \Property
	 */
	private $model;

	/**
	 * Contructor de clase
	 *
	 * @param Property $model
	 */
	function __construct(\Property $model)
	{
		$this->model = $model;
	}

	/**
	 * Retorna un listado de propiedades que pertencen a un usuario determinado
	 *
	 * @param  int $id Identificador del usuario
	 * @return Array de propiedades
	 */

	public function userProperties($id)
	{
		if(!isset($id)) {
			return NULL;
		}

		//return $this->model->where("user_id", "=", $id)->get();
		return $this->model->where("id", ">=", 0)->get(); //traigo todas las propiedades
	}


	/**
	 * Retorna una propiedad por id
	 *
	 * @param  int $id Identificador de la propiedad
	 * @return Property
	 */
	public function find($id)
	{
		return $this->getCloneOfModel()->findOrFail($id);
	}

	/**
	 * Retorna un listado de propiedades que cumplan con los parametros
	 *
	 * @param Array $paramenters
	 * @return \Illuminate\Support\Collection
	 */
	public function search($parameters){
		$query = $this->makeQuery($parameters);

		if (ParameterValidator::integer('amount', $parameters) && ParameterValidator::integer('offset', $parameters)){
			$query = $query->take($parameters['amount'])->offset($parameters['offset']);
		}

		if (array_key_exists('order', $parameters)){
			List($field, $criteria) = explode(",", $parameters['order']);
			$query = $query->orderBy($field, $criteria);
		}else{
			$query = $query->orderBy("publication_type_id", "asc");
		}

		$fields = Array(
			'id',
			'title',
			/*'main_picture',*/
			'price',
			'currency',
			'address',
			'size',
			'covered_size',
			'environment_id',
			'publication_type_id',
			'video_url'
		);

		return $query->select($fields)->get();
	}

	/**
	 * cuenta la cantidad de propiedades que matchean con los filtros
	 *
	 * @param  array $parameters
	 * @return int
	 */
	public function count($parameters)
	{
		$query = $this->makeQuery($parameters);

		return $query->count();
	}

	private function makeQuery($parameters)
	{
		$query = $this->getCloneOfModel();

		if (ParameterValidator::_list('neighborhoods', $parameters)){
			$query = $query->whereIn("neighborhood_id", explode(",", $parameters['neighborhoods']));
		}

		if (ParameterValidator::_list('propertyTypes', $parameters)){
			$query = $query->whereIn("property_type_id", explode(",",$parameters['propertyTypes']));
		}

		if (ParameterValidator::_list('operationTypes', $parameters)){
			$query = $query->whereIn("operation_type_id", explode(",", $parameters['operationTypes']));
		}

		if (ParameterValidator::_list('environments', $parameters)){
			$query = $query->whereIn("environment_id", explode(",", $parameters['environments']));
		}

		if (ParameterValidator::integer('minPrice', $parameters)){
			$query = $query->where("price", ">=", $parameters['minPrice']);
		}

		if (ParameterValidator::integer('maxPrice', $parameters)){
			$query = $query->where("price", "<=", $parameters['maxPrice']);
		}

		if (ParameterValidator::integer('minSize', $parameters)){
			$query = $query->where("size", ">=", $parameters['minSize']);
		}

		if (ParameterValidator::integer('minCoveredSize', $parameters)){
			$query = $query->where("covered_size", ">=", $parameters['minCoveredSize']);
		}

		if (ParameterValidator::date('minPublishDate', $parameters)){
			$query = $query->where("created_at", ">", $parameters['minPublishDate']);
		}

		return $query;
	}

	/**
	 * Retorna una repliac del modelo para uasr en cada query
	 *
	 * @return \Property
	 */
	private function getCloneOfModel()
	{
		return $this->model->replicate();
	}
}

?>
