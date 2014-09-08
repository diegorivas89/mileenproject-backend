<?php
namespace Mileen\Properties;

interface PropertyRepositoryInterface{
	/**
	 * Retorna una propiedad por clave primaria
	 *
	 * @param  int $id Clave primaria
	 * @return \Property
	 */
	public function find($id);

	/**
	 * Retorna una collecion de propiedades que matchean con los parametros
	 *
	 * @param array $parameters
	 * @return \Illuminte\Support\Collection
	 */
	public function search($parameters);
}

?>