<?php
namespace Mileen\Images;

/**
* Repositorio para la tabla images
*/
class ImagesRepository implements ImagesRepositoryInterface
{
	/**
	 * Modelo de Eloquent para la tabla images
	 *
	 * @var \Images
	 */
	private $model;

	/**
	 * Contructor de clase
	 *
	 * @param Image $model
	 */
	function __construct(\Image $model)
	{
		$this->model = $model;
	}

	/**
	 * Retorna una imagen por id
	 *
	 * @param  int $id Identificador de la images
	 * @return Image
	 */
	public function find($id)
	{
		return $this->model->where("id", "=", $id)->first();
	}

	/**
	 * Retorna un listado de propiedades que cumplan con los parametros
	 *
	 * @param int $propertyId
	 * @return \Illuminate\Support\Collection
	 */
	public function getImagesByProperty($propertyId){
		return $this->model->where('property_id', '=', $propertyId)->orderBy('id', 'asc')->get();
	}
}

?>