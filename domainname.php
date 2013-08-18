<?php
	
	//require_once 'MySqlDb.php';
	require 'database.php';
	require_once "simplehtmldom/simple_html_dom.php";
	//$db = new MysqlDB('localhost', 'root', '', 'test');
	$tableName = 'scraper';
	
	$filename = "BigRock.htm";
	
	$doc = new DOMDocument;
	
	$oldSetting = libxml_use_internal_errors(true);
	$doc->loadHTMLFile($filename);
	$errors = libxml_get_errors();
	
	$xpath = new DOMXPath($doc);
	
	$lists = $xpath->query(".//*[@id='content-wrapper']/table[1]/tbody/tr/td[1]");
	
	$html = new simple_html_dom();
	//$xml = $doc->saveHTML($lists->item(1));
	$xml = "";
	for ($i=0; $i < $lists->length; $i++) { 
		$xml .= $doc->saveHTML($lists->item($i)). "<br />";	
		
	}
	
	
	$html->load($xml);
	//$ret = $html->find('td.tld-col', 0);
	foreach($html->find('.tld-col')as $ret){
		$subject = $ret->plaintext;
		echo $ret->plaintext;
		echo "<br>".PHP_EOL;
		$domain = "/\.([a-z\.]{2,6})/";
		$price = "/\d+/";
		preg_match($domain, $subject, $match);
		preg_match($price, $subject, $arr);
		//echo $ret->innertext;
		$pair['domain'] = $match[0];
		$pair['price'] = $arr[0];
		
		echo save($pair);
		echo "Timestamp".time();
		$grr[]	= $pair;
		//echo $db->insert($tableName, $pair);
				
	}
	//var_dump($grr);
	// foreach ($pair as $key => $value) {
		// $insertData = "";
		// $db->insert($tableName, $pair);
	// }
	// foreach($grr as $gr){
		// echo $db->insert($tableName, $gr);
	// }
