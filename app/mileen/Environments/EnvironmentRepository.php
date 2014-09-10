<?php
namespace Mileen\Environments;

/**
* Repositorio para la tabla environments
*/
class EnvironmentRepository implements EnvironmentRepositoryInterface
{
	protected $model;

	/**
	 * Constructor de clase
	 *
	 * @param Environment $model
	 */
	public function __construct(\Environment $model)
	{
		$this->model = $model;
	}
	/**
	 * Retorna un ambiente por clave primaria
	 *
	 * @param  int $id Clave primaria
	 * @return \Environment
	 */
	public function find($id){
		return $this->model->where("id", "=", $id)->first();
	}

	/**
	 * Retorna una collecion de todos los ambientes
	 *
	 * @return \Illuminte\Support\Collection
	 */
	public function all(){
		return $this->model->all();
	}
}

?>