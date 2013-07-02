<?php
	
	$filename = 'http://bigrock.in';
	$data = file_get_contents($filename);
	$doc = new DOMDocument;
	$doc->loadHTML($data);
	$errors = libxml_get_errors();
	
	$xpath = new DOMXPath($doc);
	$lists = $xpath->query('/html/');
	
	foreach($lists as $list){
		$info[] = $list->nodeValue;
	}
	var_dump($info);
