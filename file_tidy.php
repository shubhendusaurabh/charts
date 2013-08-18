<?php
	
	for ($i=1204510001; $i <= 1204510052 ; $i++) {
		$tidy = new tidy; 
		$filepath = "downloads/{$i}.html";
		if (file_exists($filepath)){
			$tidy->parseFile($filepath);
			$issues = $tidy->errorBuffer;
			print_r($issues);
			$output = (string)$tidy;
			$fp = fopen("repaired/{$i}.htm", 'wb');
			fwrite($fp, $output);
			fclose($fp);
		}
	}
	
?>