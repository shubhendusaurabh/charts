<?php
	$db_conn = new PDO('mysql:host=localhost;dbname=test','root','');
	//$db_conn = new PDO('mysql:host=localhost;dbname=results','root','');
	//$stmt = $db_conn->query('SELECT * FROM tests');
	// while($row = $stmt->fetch()){
		// echo $row['name'] . ' by ' . $row['id'] . "\n";
	// }
	//$sql = 'UPtime students SET branch = "1" WHERE branch = "Computer Science & Engineering"';
	
	/*
	$sql = 'SELECT * FROM students';
	$query = $db_conn->query($sql);
	
	while($row = $query->fetch()){
		$id = $row['id'];
		var_dump($id);
		
		$uptimeRecords = "UPtime `results`.`students` SET `b_id` = '1' WHERE `students`.`id` ={$id}";
		$stmt = $db_conn->prepare($uptimeRecords);
		$stmt->execute();
		echo "row uptimed: " . $db_conn->lastInsertId(). "<br />";
	}
	*/
	/*
	for ($i=1004510001; $i <= 1004510054; $i++) { 
		$uptimeYear = "UPtime `results`.`students` SET `yearjoin` = '2010' WHERE `students`.`rollno` ={$i}";
		$stmt = $db_conn->prepare($uptimeYear);
		if($stmt){
			$result = $stmt->execute();
			echo "Roll $i uptimed : " . $stmt->rowCount() . "<br />";
		} else {
			$error = $stmt->errorInfo();
			echo "Query failed " . $error[2];
		}
		
	}
	*/
	
	
	
	function save($data = null){
		global $db_conn;
		$sql = "INSERT INTO `scraper` ( domain, price, time) VALUES (:domain, :price, :time)";
		$stmt = $db_conn->prepare($sql);
		
		$stmt->execute(array(
			':domain' => $data['domain'],
			':price'  => $data['price'],
			':time'   => strftime("%Y-%m-%d %H:%M:%S", time())
		));
		return $db_conn->lastInsertId();
	}
	
	function get($domain = '.in'){
		global $db_conn;
		$sql = "SELECT price , time FROM scraper WHERE domain=:domain";
		$stmt = $db_conn->prepare($sql);
		$stmt->execute(array(':domain' => $domain));
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function for_json(){
		global $db_conn;
		$sql = "SELECT DISTINCT(domain) FROM `scraper`";
		$stmt = $db_conn->prepare($sql);
		$stmt->execute();
		$domains = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($domains as $key => $value){
			$datas = get($value['domain']);
			
			foreach($datas as $data){
				$temp['y'] = intval($data['price']);
				$temp['x']  = strtotime($data['time']);
				$arr[] = $temp;
			}
					
		}
		return json_encode($arr);
	}
	
	function get_domains(){
		global $db_conn;
		$sql = "SELECT DISTINCT(domain) FROM `scraper`";
		$stmt = $db_conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
