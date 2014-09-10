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

		if (ParameterValidator::_list('property_types', $parameters)){
			$this->model = $this->model->whereIn("property_type_id", explode(",",$parameters['property_types']));
		}

		if (ParameterValidator::_list('operation_types', $parameters)){
			$this->model = $this->model->whereIn("operation_type_id", explode(",", $parameters['operation_types']));
		}

		if (ParameterValidator::_list('environments', $parameters)){
			$this->model = $this->model->whereIn("environment_id", explode(",", $parameters['environments']));
		}

		if (ParameterValidator::integer('min_price', $parameters) && ParameterValidator::integer('max_price', $parameters)){
			$this->model = $this->model->whereBetween("price", [$parameters['min_price'], $parameters['max_price']]);
		}

		if (ParameterValidator::integer('min_size', $parameters)){
			$this->model = $this->model->where("size", ">=", $parameters['min_size']);
		}

		if (ParameterValidator::integer('min_covered_size', $parameters)){
			$this->model = $this->model->where("covered_size", ">=", $parameters['min_covered_size']);
		}

		if (ParameterValidator::date('min_publish_date', $parameters)){
			$this->model = $this->model->where("created_at", ">", $parameters['min_publish_date']);
		}

		if (ParameterValidator::integer('amount', $parameters) && ParameterValidator::integer('offset', $parameters)){
			$this->model = $this->model->take($parameters['amount'])->offset($parameters['offset']);
		}

		if (array_key_exists('order', $parameters)){
			List($field, $criteria) = explode(",", $parameters['order']);
			$this->model = $this->model->orderBy($field, $criteria);
		}

		$fields = Array(
			'id',
			/*'main_picture',*/
			'price',
			'currency',
			'address',
			'size',
			'covered_size',
			'environment_id',
			'operation_type_id'
		);

		return $this->model->select($fields)->get();
	}
}

?>