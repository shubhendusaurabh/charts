<?php

$season = array(1 => 'Annual', 2 => 'Jan-Feb', 3 => 'Mar-May', 4 => 'Jun-Sep', 5 => 'Oct-Dec');
$color = array(1 => '#c05020', 2 => '#f68f6e', 3 => '#f85a6a', 4 => '#c6df45', 5 => '#f0f0f0');

$fp = fopen("maximum-temperature.csv", "r");

$arr = array();
while ($line = fgetcsv($fp)) {
	$arr[] = $line;
}
fclose($fp);
array_shift($arr);
//array_shift($arr);
$temperature = array();
foreach ($season as $key => $value) {
	
	$year = 1901;
	$lol = array();
	foreach ($arr as $a) {
		$temp['x'] = mktime(22,0,0,12,13,$year++);
		$temp['y'] = floatval($a[$key]);
		$lol[] = $temp;
		$temperature[$value][$year-1] = floatval($a[$key]);

	}
	$data['data'] = $lol;
	$data['name'] = $value;
	$data['color'] = $color[$key];
	$s[] = $data;
	$min[] = max($temperature[$value]);
}
var_dump($min);
var_dump($temperature);
?>

		<h2>See the mimimum temperature over the years</h2>
		<div id="chart_container">
			<div id="y_axis"></div>
			<div id="chart"></div>

		</div>
		<div id="legend_container">
			<div id="smoother" title="Smoothing"></div>
			<div id="legend"></div>
		</div>
		&deg; &cent; &cedil;
		<script>
	
			var seriesData = [<?php  echo json_encode($s); ?>];
	
			var graph = new Rickshaw.Graph({
				element : document.getElementById("chart"),
				width : 1000,
				height : 350,
				renderer : 'line',
				series : <?php echo json_encode($s); ?>
			});
			
			var y_ticks = new Rickshaw.Graph.Axis.Y({
				graph : graph,
				orientation : 'left',
				tickFormat : Rickshaw.Fixtures.Number.formatKMBT,
				element : document.getElementById('y_axis'),
			});
			var axes = new Rickshaw.Graph.Axis.Time({
				graph : graph
			});
		
			
			var hoverDetail = new Rickshaw.Graph.HoverDetail({
				graph : graph
			});
		
			var legend = new Rickshaw.Graph.Legend({
				graph : graph,
				element : document.getElementById('legend')
		
			});
		
			var shelving = new Rickshaw.Graph.Behavior.Series.Toggle({
				graph : graph,
				legend : legend
			});
			graph.render();

		</script>
