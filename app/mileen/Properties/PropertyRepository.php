<?php
namespace Mileen\Properties;


/**
*
*/
class PropertyRepository implements PropertyRepositoryInterface
{
	private $model;

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
		/*
		*neighborhoods: identificadores únicos de barrios separados por comas
		*property_types: identificadores de tipos de propiedad separados por comas
		*operation_types: identificadores de tipos de operacion separados por comas
		*environments: identificadores de la cantidad de ambientes separados por comas
		*min_price: precio minimo de la propiedad
		*max_price: precio maximo de la propiedad
		*min_m2: cantidad minima de m2 de la propiedad
		*min_publish_date: fecha minima de publicacion, formato YY-mm-dd
		*amount: cantidad de propiedades a devolver
		*offset: cantidad de propiedades a saltear
		*order: campo por el cual se puede ordenar el listado y forma de ordenarlo (asc o desc). Por ejemplo order=price,desc
		*/

		if (array_key_exists('neighborhoods', $parameters)){
			$this->model = $this->model->whereIn("neighborhood_id", explode(",", $parameters['neighborhoods']));
		}

		if (array_key_exists('property_types', $parameters)){
			$this->model = $this->model->whereIn("property_type_id", explode(",",$parameters['property_types']));
		}

		if (array_key_exists('operation_types', $parameters)){
			$this->model = $this->model->whereIn("operation_type_id", explode(",", $parameters['operation_types']));
		}

		if (array_key_exists('environments', $parameters)){
			$this->model = $this->model->whereIn("environment_id", explode(",", $parameters['environments']));
		}

		if (array_key_exists('min_price', $parameters) && array_key_exists('max_price', $parameters)){
			$this->model = $this->model->whereBetween("price", [$parameters['min_price'], $parameters['max_price']]);
		}

		if (array_key_exists('min_m2', $parameters)){
			$this->model = $this->model->where("size", ">=", $parameters['min_m2']);
		}

		if (array_key_exists('min_publish_date', $parameters)){
			$this->model = $this->model->where("created_at", ">", $parameters['min_publish_date']);
		}

		if (array_key_exists('amount', $parameters) && array_key_exists('offset', $parameters)){
			$this->model = $this->model->take($parameters['amount'])->offset($parameters['offset']);
		}

		if (array_key_exists('order', $parameters)){
			List($field, $criteria) = explode(",", $parameters['order']);
			$this->model = $this->model->orderBy($field, $criteria);
		}

		return $this->model->get();
	}
}

?>