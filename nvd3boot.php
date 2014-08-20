<?php

$season = array(1 => 'Annual', 2 => 'Jan-Feb', 3 => 'Mar-May', 4 => 'Jun-Sep', 5 => 'Oct-Dec');
$color = array(1 => '#c05020', 2 => '#f68f6e', 3 => '#f85a6a', 4 => '#c6df45', 5 => '#f0f0f0');

$fp = fopen("data/RD08.csv", "r");

$arr = array();
while ($line = fgetcsv($fp)) {
	$arr[] = $line;
}
fclose($fp);
array_shift($arr);
//var_dump($arr);
/*
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
 * 
 */
//var_dump($min);
//var_dump($temperature);
?>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Charts</title>
	<link rel="stylesheet" href="http://localhost/datavisuals/assests/css/bootstrap.min.css" />
	<link rel="stylesheet" href="http://localhost/datavisuals/assests/css/styles.css" />
	<link rel="stylesheet" href="http://localhost/datavisuals/assests/css/nv.d3.css" />
	<script src="http://localhost/datavisuals/assests/js/jquery-2.0.0.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/bootstrap.min.js"></script>
	<script src="http://localhost/datavisuals/assests/js/d3.v3.js"></script>
	<script src="http://localhost/datavisuals/assests/js/nv.d3.js"></script>
	
</head>
<body>
	<div class="container">
		<h2>See the mimimum temperature over the years</h2>
		<div id="chart_container">
			<div id="y_axis"></div>
			<div id="chart"></div>

		</div>
		<div id="legend_container">
			<div id="smoother" title="Smoothing"></div>
			<div id="legend"></div>
		</div>
		<script>
	
			var seriesData = [<?php // echo json_encode($s); ?>];
	

		</script>

	</div>
</body>
</html>