<?php

$category = array(1 => 'Rural India', 2 => 'Urban India', 3 => 'Total');
$color = array(1 => '#c05020', 2 => '#f68f6e', 3 => '#f85a6a', 4 => '#c6df45', 5 => '#f0f0f0');

$fp = fopen("data/RD08.csv", "r");

$arr = array();
while ($line = fgetcsv($fp)) {
	$arr[] = $line;
}
fclose($fp);
array_shift($arr);
//var_dump($arr);
$number = array();
foreach ($category as $key => $value) {
	$year = 1963;
	$lol = array();
	foreach($arr as $a){
		$temp['x'] = mktime(0,0,0,1,1,$year+=10);
		$temp['y'] = floatval($a[$key]);
		$lol[] = $temp;
		$number[$value][$year-1] = floatval($a[$key]);
		//var_dump($year);
	}
	$data['data'] = $lol;
	$data['name'] = $value;
	$data['color'] = $color[$key];
	$s[] = $data;
}
?>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Charts</title>
	<link rel="stylesheet" href="http://localhost/datavisuals/assests/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://localhost/datavisuals/assests/css/styles.css" />
	<link rel="stylesheet" href="http://localhost/datavisuals/assests/css/rickshaw.min.css" />
	<script src="http://localhost/datavisuals/assests/js/jquery-2.0.0.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/jquery-ui-1.9.1.custom.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/bootstrap.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/d3.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/d3.layout.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/rickshaw.min.js"></script>
</head>
<body>
	<div class="container">
		<h2>Poverty in India</h2>
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
				width : 900,
				height : 350,
				//renderer : 'line',
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

	</div>
</body>
</html>