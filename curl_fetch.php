<?php
	function get_data($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($ch, CURLOPT_PROXY, '192.162.0.76');
		//curl_setopt($ch, CURLOPT_PROXYPORT, '3128');
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
	for ($i=1104510006; $i <= 1104510059 ; $i++) {
		$url =  "http://hbti.ac.in/coe/results/odd_2012/hbti_odd1213.asp?rollno={$i}";
		$content = get_data($url);
		$fp = fopen("{$i}.html", "wb");
		fwrite($fp, $content);
		fclose($fp);
	}
	
?>
