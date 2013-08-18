<?php

	

	$db_conn = new PDO('mysql:host=localhost;dbname=results','root','');
	for($n = 1104510001; $n <= 1104510059; $n++){
		$filepath = "repaired/{$n}.htm";
		if (file_exists($filepath)){
			$data = file_get_contents($filepath);
			$oldsetting = libxml_use_internal_errors(TRUE);
			$marks = array();
			$info = Array();
			$doc = new DOMDocument;
			$doc->loadHTMLFile($filepath);
			$errors = libxml_get_errors();
			//echo $errors;
			$xpath = new DOMXPath($doc);
			$student_info = $xpath->query('/html/body/table/tr/td/table/tr/td[2]');
			foreach($student_info as $s_info){
				$info[] = $s_info->nodeValue;
			}
			if(empty($info)){
				echo "No go for $n";
				continue;
			}
			//var_dump($info);
				//sem 4 => 4 - 12
				//sem 3 => 14 - 22
				//sem 7 => 3 - 11
				for($j = 4; $j <= 12; $j++){
					$lists = $xpath->query("/html/body/table/tr/td/table[2]/tr[2]/td/table/tr[{$j}]/td");
					//var_dump($lists);
					foreach($lists as $list){
						//var_dump($list);
						//var_dump($list->nodeValue);
						//echo $list->nodeValue, PHP_EOL;
						//echo "<br />";
						$marks[] = $list->nodeValue;
					}
				}
				//var_dump($marks);
				//echo "<br />";
				// foreach ($info as $key => $value) {
					// echo $key . " => " . $value ."<br />";
				// }
				if(empty($info)){
					echo "No go for {$n} <br />";
					continue;
				}
				$rollno = $info[2];
				$sql = 'SELECT rollno, id FROM students WHERE rollno = ?';
				$stmt = $db_conn->prepare($sql);
				$stmt->execute(array($rollno));
				$student = $stmt->fetch(); 
				//var_dump($student);
				$id = $student[1];
				//echo $id;
				/*
				$query = 'INSERT INTO marks (student_id, branch_id, semester, ele1, ele1int, ele2, ele2int, ele3, ele3int, ele4, ele4int, ele5, ele5int, elp1, elp2, elp3, hgp, total) 
							VALUES (:id, "1", "4", :ele1, :ele1int, :ele2, :ele2int, :ele3, :ele3int, :ele4, :ele4int, :ele5, :ele5int, :elp1, :elp2, :elp3, :hgp, :total)';
				$statement = $db_conn->prepare($query);
				$statement->execute(array(
					':id' => $id,
					':ele1' => $marks[4],
					':ele1int' => $marks[5],
					':ele2' => $marks[11],
					':ele2int' => $marks[12],
					':ele3' => $marks[18],
					':ele3int' => $marks[19],
					':ele4' => $marks[25],
					':ele4int' => $marks[26],
					':ele5' => $marks[32],
					':ele5int' => $marks[33],
					':elp1' => $marks[41],
					':elp2' => $marks[48],
					':elp3' => $marks[55],
					':hgp' => $marks[62],
					':total' => ($marks[6] + $marks[13] + $marks[20] + $marks[27] + $marks[34] + $marks[41] + $marks[48] + $marks[55] + $marks[62])
				));
				echo "Last insert id: " . $db_conn->lastInsertId() . "<br />";
				*/
				
			
		}
	}
?>