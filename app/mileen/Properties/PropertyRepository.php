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

		return $this->model->where("user_id", "=", $id)->get();
	}


	/**
	 * Retorna una propiedad por id
	 *
	 * @param  int $id Identificador de la propiedad
	 * @return Property
	 */
	public function find($id)
	{
		return $this->model->where("id", "=", $id)->first();
	}

	/**
	 * Retorna un listado de propiedades que cumplan con los parametros
	 *
	 * @param Array $paramenters
	 * @return \Illuminate\Support\Collection
	 */
	public function search($parameters){
		if (ParameterValidator::_list('neighborhoods', $parameters)){
			$this->model = $this->model->whereIn("neighborhood_id", explode(",", $parameters['neighborhoods']));
		}

		if (ParameterValidator::_list('propertyTypes', $parameters)){
			$this->model = $this->model->whereIn("property_type_id", explode(",",$parameters['propertyTypes']));
		}

		if (ParameterValidator::_list('operationTypes', $parameters)){
			$this->model = $this->model->whereIn("operation_type_id", explode(",", $parameters['operationTypes']));
		}

		if (ParameterValidator::_list('environments', $parameters)){
			$this->model = $this->model->whereIn("environment_id", explode(",", $parameters['environments']));
		}

		if (ParameterValidator::integer('minPrice', $parameters) && ParameterValidator::integer('maxPrice', $parameters)){
			$this->model = $this->model->whereBetween("price", [$parameters['minPrice'], $parameters['maxPrice']]);
		}

		if (ParameterValidator::integer('minSize', $parameters)){
			$this->model = $this->model->where("size", ">=", $parameters['minSize']);
		}

		if (ParameterValidator::integer('minCoveredSize', $parameters)){
			$this->model = $this->model->where("covered_size", ">=", $parameters['minCoveredSize']);
		}

		if (ParameterValidator::date('minPublishDate', $parameters)){
			$this->model = $this->model->where("created_at", ">", $parameters['minPublishDate']);
		}

		if (ParameterValidator::integer('amount', $parameters) && ParameterValidator::integer('offset', $parameters)){
			$this->model = $this->model->take($parameters['amount'])->offset($parameters['offset']);
		}

		if (array_key_exists('order', $parameters)){
			List($field, $criteria) = explode(",", $parameters['order']);
			$this->model = $this->model->orderBy($field, $criteria);
		}else{
			$this->model = $this->model->orderBy("publication_type_id", "asc");
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
			'publication_type_id'
		);

		return $this->model->select($fields)->get();
	}
}

?>
