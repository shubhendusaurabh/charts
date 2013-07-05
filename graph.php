<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Showing graph</title>
		<link rel="stylesheet" href="rickshaw.min.css" />
		<script src="jquery.js"></script>
		<script src="jquery-ui-1.9.1.custom.min.js"></script>
		<script src="d3.min.js"></script>
		<script src="d3.layout.min.js"></script>
		<script src="rickshaw.min.js"></script>
	</head>
	<body>
		Here you will see the graph
		<div id="chart1"> </div>
		<div id="chart_container">
			<div id="chart"> </div>
			<div id="legend_container">
				<div id="smoother" title="Smoothing"> </div>
				<div id="legend"> </div>
			</div>
			<div id="slider"> </div>
		</div>
<?php 
require_once('database.php');
// $datas = get();
// $arr = array();
// foreach($datas as $data){
	// $temp['y'] = intval($data['price']);
	// $temp['x']  = strtotime($data['time']);
	// $arr[] = $temp;
// }
$domains = get_domains();

foreach($domains as $domain){
	$temp = get($domain['domain']);
	//var_dump($temp);
	$lol = array();
	foreach($temp as $t){
		
		$arr['y'] = intval($t['price']);
		$arr['x'] = strtotime($t['time']);
		$lol[] = $arr;
	}
	//$data['data'] = $temp;
	$data['data'] = $lol;
	$data['color'] = "#c05020";
	$data['name'] = $domain['domain'];
	$s[] = $data;
}
//var_dump($data);
echo json_encode($s);
?>
		<script>
			
			
			var seriesData = [<?php echo json_encode($data); ?>];
			

			var graph = new Rickshaw.Graph({
				element : document.getElementById("chart"),
				width : 960,
				height : 500,
				renderer : 'line',
				series : <?php echo json_encode($s); ?>
				
			});
			//console.log(series);
			graph.render();

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

			var axes = new Rickshaw.Graph.Axis.Time({
				graph : graph
			});
			axes.render();
			
		</script>
	</body>
</html>