<?php
	$filepath = 'repaired/1204510001.htm';
	$data = file_get_contents($filepath);
	$oldsetting = libxml_use_internal_errors(TRUE);
	$info = new ArrayObject;
	$doc = new DOMDocument;
	$doc->loadHTMLFile($filepath);
	$errors = libxml_get_errors();
	//echo $errors;
	$xpath = new DOMXPath($doc);
	$lists = $xpath->query('/html/body/table/tr/td/table/tr');
	//var_dump($lists);
	foreach($lists as $list){
		//var_dump($list);
		//var_dump($list->nodeValue);
		//echo $list->nodeValue, PHP_EOL;
		//echo "<br />";
		$info[] = $list->nodeValue;
	}
	print_r($info);
	echo "<br />";
	var_dump($info);
	//echo $data;
?>
