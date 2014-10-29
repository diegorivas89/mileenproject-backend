<?php
namespace Mileen\Charts;
/**
*
*/
class Pie extends Chart
{

	function __construct($title = '')
	{
		parent::__construct($title);
	}

	public function plot($width, $height)
	{
		$graph = new \PieGraph($width, $height);
		$graph->SetShadow();

		$graph->title->Set($this->title);

		$pie = new \PiePlot(array_values($this->data));
		$graph->Add($pie);

		$filename = $this->generateChartFilename();

		$graph->Stroke(public_path().$filename);

		return $filename;
	}
}

?>