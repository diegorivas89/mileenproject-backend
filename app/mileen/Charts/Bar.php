<?php
namespace Mileen\Charts;

require_once app_path().'/libs/jpgraph/src/jpgraph.php';
require_once app_path().'/libs/jpgraph/src/jpgraph_bar.php';

/**
*
*/
class Bar
{
	protected $storePath;
	protected $title;
	protected $xTitle;
	protected $yTitle;
	protected $data;

	function __construct($title = '')
	{
		$this->title = $title;
		$this->xTitle = '';
		$this->yTitle = '';
		$this->data = [];
		$this->storePath = "/store/chart/";
	}

	public function setTitle($title, $xTitle = '', $yTitle = '')
	{
		$this->title = $title;
		$this->xTitle = $xTitle;
		$this->yTitle = $yTitle;

		return $this;
	}

	public function setData($data)
	{
		$this->data = $data;

		return $this;
	}

	public function plot($width, $height)
	{
		$datay = array_values($this->data);
		$datax = array_keys($this->data);
		// Create the graph. These two calls are always required
		$graph = new \Graph($width, $height);
		$graph->SetScale('intlin');

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
		//$graph->title->SetFont(FF_ARIAL,FS_BOLD,14);
		$graph->xaxis->title->Set($this->xTitle);
		$graph->yaxis->title->Set($this->yTitle);

		// Store graph
		$filename = $this->storePath.md5(microtime().rand(1,9999)).".png";
		$graph->Stroke(public_path().$filename);

		return $filename;
	}
}

?>