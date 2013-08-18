<?php
	$db_conn = new PDO('mysql:host=localhost;dbname=results','root','');
	for($n = 1204510001; $n <= 1204510052; $n++){
		$filepath = "repaired/{$n}.htm";
		$data = file_get_contents($filepath);
		$oldsetting = libxml_use_internal_errors(TRUE);
		$info = array();
		$doc = new DOMDocument;
		$doc->loadHTMLFile($filepath);
		$errors = libxml_get_errors();
		//echo $errors;
		$xpath = new DOMXPath($doc);
		$lists = $xpath->query('/html/body/table/tr/td/table/tr/td[2]');
		//var_dump($lists);
		foreach($lists as $list){
			//var_dump($list);
			//var_dump($list->nodeValue);
			//echo $list->nodeValue, PHP_EOL;
			//echo "<br />";
			$info[] = $list->nodeValue;
		}
		//var_dump($info);
		echo $info[0];
		echo "<br />";
		
		if (empty($info)) {
			echo "No go for => {$n}<br />";
		} else {
			//echo $info[2];
			/*
		$sql1 = 	"SELECT id FROM students WHERE rollno = :roll";
		$stmt1 = $db_conn->prepare($sql1);
		$stmt1->execute(array("roll" => $info[2]));
		$row = $stmt1->fetch();
		
		
		/*
		$sql = "UPDATE `results`.`students` SET `fathername` = :fathername WHERE `students`.`id` = :id";
		 $stmt = $db_conn->prepare($sql);
		 $stmt->execute(array(
		 	':fathername' => $info[1],
		 	':id' => $row[0]
		 ));
		 echo "Last insert id: " . $db_conn->lastInsertId() . "<br />";
		 
		 echo $stmt->rowCount() . ' rows updated';
		
		*/
		$sql = 'INSERT INTO students (name, fathername, rollno, b_id, course, yearjoin) VALUES (:name, :fathername, :rollno, :branch, :course, :yearjoin)';
		$stmt = $db_conn->prepare($sql);
		
		$stmt->execute(array(
			':name' => $info[0],
			':fathername' => $info[1],
			':rollno' => $info[2],
			':branch' => 'Computer Science & Engineering',
			':course' => 'B.Tech',
			':yearjoin' => '2012'
		));
		echo "Last insert id: " . $db_conn->lastInsertId(). "<br />";
		
		 
		 
		 
		 
		 
		 
		}
		
		
	}
?>