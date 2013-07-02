<?php
	
	for ($i=904510001; $i <= 904510054 ; $i++) {
		$tidy = new tidy; 
		$filepath = "downloads/0{$i}.html";
		if (file_exists($filepath)){
			$tidy->parseFile($filepath);
			$issues = $tidy->errorBuffer;
			print_r($issues);
			$output = (string)$tidy;
			$fp = fopen("repaired/0{$i}.htm", 'wb');
			fwrite($fp, $output);
			fclose($fp);
		}
	}
	
?>