<?php
namespace Mileen\Charts;

/**
*
*/
class Bar extends Chart
{
	protected $xTitle;
	protected $yTitle;

	function __construct($title = '')
	{
		parent::__construct($title);

		$this->xTitle = '';
		$this->yTitle = '';
	}

	/**
	 * Setea el titulo del grafico, y el de los ejes x e y
	 *
	 * @param string $title
	 * @param string $xTitle
	 * @param string $yTitle
	 */
	public function setTitle($title, $xTitle = '', $yTitle = '')
	{
		parent::setTitle($title);
		$this->xTitle = $xTitle;
		$this->yTitle = $yTitle;

		return $this;
	}

	/**
	 * Genera el grafico7
	 *
	 * @param type $width
	 * @param type $height
	 * @return type
	 */
	public function plot($width, $height)
	{
		$datay = array_values($this->data);
		$datax = array_keys($this->data);
		// Create the graph. These two calls are always required
		$graph = new \Graph($width, $height);
		$graph->SetScale('textlin');

		// Add a drop shadow
		$graph->SetShadow();

		// Adjust the margin a bit to make more room for titles
		$graph->SetMargin(40,30,20,40);

		$graph->xaxis->SetTickLabels($datax);
		//$graph->xaxis->SetLabelAngle(90);

		// Create a bar pot
		$bplot = new \BarPlot($datay);

		// Adjust fill color
		$bplot->SetFillColor('orange');
		$graph->Add($bplot);

		// Setup the titles
		$graph->title->Set($this->title);
		//$graph->title->SetFont(FF_ARIAL, FS_BOLD, 18);
		$graph->title->SetFont(FF_DEFAULT,FS_NORMAL, 17);
		$graph->xaxis->title->Set($this->xTitle);
		$graph->yaxis->title->Set($this->yTitle);

		// Store graph
		$filename = $this->generateChartFilename();

		$graph->Stroke(/*public_path().$filename*/);

		return $filename;
	}
}

?>