<?php
namespace Mileen\Images;

interface ImagesRepositoryInterface{
	/**
	 * Retorna una imagen por clave primaria
	 *
	 * @param  int $id Clave primaria
	 * @return \Image
	 */
	public function find($id);

	/**
	 * Retorna las imagenes de una propiedad
	 *
	 * @param int $propertyId
	 * @return \Illuminte\Support\Collection
	 */
	public function getImagesByProperty($propertyId);
}

?>