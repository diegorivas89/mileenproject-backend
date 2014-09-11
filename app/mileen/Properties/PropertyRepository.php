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
	public function search($paramenters){
		return $this->model->where("id", ">", 0)->get();
	}
}

?>
