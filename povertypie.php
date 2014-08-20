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
foreach ($arr as $a) {
	//var_dump($a);

	$data = array();
	$temp['total'] = $a[3];
	$temp['label'] = $a[0];
	$temp['key'] = $category[2];
	$temp['y'] = $a[2];
	$temp['per'] = round((($a[2] / $a[3]) * 100), 2);
	$data[] = $temp;

	$temp['key'] = $category[1];
	$temp['y'] = $a[1];
	$temp['per'] = 100 - $temp['per'];

	$data[] = $temp;

	$s[] = $data;

}
//var_dump($s);
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
		<style>
			svg {
				width: 500px;
				border: 2px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<h2>See the mimimum temperature over the years</h2>
			<div class="row">
				<div class="span6">
					<svg id="chart"></svg>
				</div>
				<div class="span6">
					<svg id="chart1"></svg>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<svg id="chart2"></svg>
				</div>
				<div class="span6">
					<svg id="chart3"></svg>
				</div>
			</div>

			<script>
			var testdata =<?php echo json_encode($s[0]); ?>;
			var testdata1 = <?php echo json_encode($s[1]); ?>;
			var testdata2 = <?php echo json_encode($s[2]); ?>;
			var testdata3 = <?php echo json_encode($s[3]); ?>;
			var width = 500, height = 500;
		
			var chart = nv.models.pieChart().x(function(d) {
				return d.key + ": " + Math.round(d.per) + "%"
			}).y(function(d) {
				return d.y
			}).showLabels(true).values(function(d) {
				return d
			}).color(d3.scale.category20().range()).width(width).height(height);
			var tp = function(key, y, e, graph) {
				return '<h3>' + key + '</h3>' + '<p>No of persons: ' + y + '</p>' + '<p>Percentage: ' + e.point.per + '%</p>' + '<p>Total: ' + e.point.total + '</p>'+ '<p>Year: ' + e.point.label + '</p>';
			};
			chart.tooltipContent(tp);
			function plot(id, data) {
		
				d3.select(id).datum([data]).transition().duration(1200).attr('width', width).attr('height', height).call(chart);
		
				chart.dispatch.on('stateChange', function(e) {
					nv.log('New State:', JSON.stringify(e));
				});
		
				return chart;
			}
		
		
			nv.addGraph(plot("#chart", testdata));
			nv.addGraph(plot("#chart1", testdata1));
			nv.addGraph(plot("#chart2", testdata2));
			nv.addGraph(plot("#chart3", testdata3));

			</script>
			
		</div>
	</body>
</html>