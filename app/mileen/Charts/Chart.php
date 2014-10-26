<?php
namespace Mileen\Charts;

require_once app_path().'/libs/jpgraph/src/jpgraph.php';
require_once app_path().'/libs/jpgraph/src/jpgraph_bar.php';

/**
*
*/
abstract class Chart
{
	protected $storePath;
	protected $title;
	protected $data;

	function __construct($title = '')
	{
		$this->title = $title;
		$this->storePath = '/store/chart';
		$this->data = [];
	}

	/**
	 * Setea el titulo del grafico
	 *
	 * @param string $title
	 */
	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * Setea la data para generar el grafico
	 *
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Genera el grafico
	 *
	 * @param int $width 	Ancho de la imagen del grafico
	 * @param int $height 	Alto de la imagen del grafico
	 * @return string 		Nombre del archivo generado con el grafico
	 */
	public abstract function plot($width, $height);

	/**
	 * Genera el nombre del archivo donde se va a guardar el grafico
	 *
	 * @return string
	 */
	protected function generateChartFilename()
	{
		return $this->storePath.'/'.md5(microtime().rand(1,9999)).".png";
	}
}

?>