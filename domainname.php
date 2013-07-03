<?php
	
	//$filename = 'Libraries\Documents\IN Domain Registration & other Domain Registration Pricing List - BigRock.htm';
	//$filename = 'BigRock.htm';
	$filename = "http://www.bigrock.in/domain-registration/domain-registration-price.php";
	$filename = "http://www.bigrock.in/";
	$filename = "BigRock.htm";
	$filename = "bigindex.htm";
	//$data = file_get_contents($filename);
	//var_dump($data);
	//$data = 
	$info = new ArrayObject;
	$doc = new DOMDocument;
	$doc->loadHTMLFile($filename);
	$errors = libxml_get_errors();
	
	$xpath = new DOMXPath($doc);
	$lists = $xpath->query('/html/body/div[4]/div/div[4]/div[3]/div[2]/div/div[4]/div[2]/div/ul/li/div');
	$lists = $xpath->query(".//*[@id='region-top']/div[1]/div[4]/div[2]/div[1]/ul/li/div");
	//$lists = $xpath->query('/*[@class=“price-list”');
	
	foreach($lists as $list){
		$info[] = $list->nodeValue;
		echo $list->nodeValue."<br />";
	}
	
	//echo $errors;
	//var_dump($info);
	// echo "<pre>";
	// print_r($info);
	// echo "</pre>";
	foreach ($info as $key => $value) {
		echo $key . " => " . trim($value) . "<br />"; 
	}
