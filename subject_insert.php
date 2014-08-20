<?php
	$db_conn = new PDO('mysql:host=localhost;dbname=results','root','');
	

	$sql = 'INSERT INTO subjects (b_id, semester, subject1, subject2, subject3, subject4, subject5, lab1, lab2, lab3)
			VALUES ("1", "4", "Database Management", "Software Engineering", "Computer Organisation", "P.P.L", "Network Analysis and Systhesis", "Database Management Systems Lab", "Software Engineering Lab", "Network Lab")';
	$stmt = $db_conn->prepare($sql);
	$stmt->execute();
	echo "new subject id: " . $db_conn->lastInsertId();
	
	
	
?>