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
	public function search($paramenters){
		return $this->model->where("id", ">", 0)->get();
	}
}

?>