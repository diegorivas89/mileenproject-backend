<?php
namespace Mileen\Environments;

/**
*
*/
interface EnvironmentRepositoryInterface
{
	/**
	 * Retorna un ambiente por clave primaria
	 *
	 * @param  int $id Clave primaria
	 * @return \Environment
	 */
	public function find($id);

	/**
	 * Retorna una collecion de todos los ambientes
	 *
	 * @return \Illuminte\Support\Collection
	 */
	public function all();
}

?>