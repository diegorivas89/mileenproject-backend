<?php
namespace Mileen\Charts;
/**
*
*/
class Pie extends Chart
{
	const TITLE_SIZE = 25;
	const AXIS_TITLE_SIZE = 20;

	function __construct($title = '')
	{
		parent::__construct($title);
	}

	public function plot($width, $height)
	{
		$graph = new \PieGraph($width, $height);
		$graph->SetShadow();

		$graph->title->Set($this->title);
		$graph->title->SetFont(FF_DEFAULT, FS_NORMAL, self::TITLE_SIZE);

		$pie = new \PiePlot(array_values($this->data));
		$pie->SetLegends(array_keys($this->data));

		$graph->Add($pie);

		$filename = $this->generateChartFilename();

		$graph->Stroke();
		//$graph->Stroke(public_path().$filename);

		return $filename;
	}
}

?>