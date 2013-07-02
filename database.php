<?php
	$db_conn = new PDO('mysql:host=localhost;dbname=results','root','');
	//$stmt = $db_conn->query('SELECT * FROM tests');
	// while($row = $stmt->fetch()){
		// echo $row['name'] . ' by ' . $row['id'] . "\n";
	// }
	//$sql = 'UPDATE students SET branch = "1" WHERE branch = "Computer Science & Engineering"';
	
	/*
	$sql = 'SELECT * FROM students';
	$query = $db_conn->query($sql);
	
	while($row = $query->fetch()){
		$id = $row['id'];
		var_dump($id);
		
		$updateRecords = "UPDATE `results`.`students` SET `b_id` = '1' WHERE `students`.`id` ={$id}";
		$stmt = $db_conn->prepare($updateRecords);
		$stmt->execute();
		echo "row updated: " . $db_conn->lastInsertId(). "<br />";
	}
	*/
	for ($i=1004510001; $i <= 1004510054; $i++) { 
		$updateYear = "UPDATE `results`.`students` SET `yearjoin` = '2010' WHERE `students`.`rollno` ={$i}";
		$stmt = $db_conn->prepare($updateYear);
		if($stmt){
			$result = $stmt->execute();
			echo "Roll $i updated : " . $stmt->rowCount() . "<br />";
		} else {
			$error = $stmt->errorInfo();
			echo "Query failed " . $error[2];
		}
		
	}
	
	
?>