<?php

	$folder = "downloads/";
	$output = "compressed.zip";
	
	$zip = new ZipArchive();
	if ($zip->open($output, ZipArchive::CREATE) !== TRUE){
		die ("unable to open zip archive");
	}
	
	$all = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder));
	foreach($all as $f=>$value){
		$zip->addFile(realpath($f), $f) or die("ERROR: unable to add file : $f");
	}
	$zip->close();
	echo "Compressed Successfully";

?>

