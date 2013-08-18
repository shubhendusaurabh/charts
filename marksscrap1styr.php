<?php
	$db_conn = new PDO('mysql:host=localhost;dbname=results','root','');
	for($n = 1204510001; $n <= 1204510052; $n++){
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
			//var_dump($info);
			//2nd sem 4->14
			//1st sem 15->24
			for($j = 15; $j <= 24; $j++){
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
			//foreach ($info as $key => $value) {
				//echo $key . " => " . $value ."<br />";
			//}
			
			if(empty($info)){
				echo "No go for {$n}";
				continue;
			}
			$rollno = $info[2];
			$sql = 'SELECT rollno, id FROM students WHERE rollno = ?';
			$stmt = $db_conn->prepare($sql);
			$stmt->execute(array($rollno));
			$student = $stmt->fetch(); 
			var_dump($student);
			$id = $student[1];
			//echo $id;
			
			$query = 'INSERT INTO marks (student_id, branch_id, semester, ele1, ele1int, ele2, ele2int, ele3, ele3int, ele4, ele4int, ele5, ele5int, elp1, elp2, elp3, hgp, total) 
						VALUES (:id, "1", "1", :ele1, :ele1int, :ele2, :ele2int, :ele3, :ele3int, :ele4, :ele4int, :ele5, :ele5int, :elp1, :elp2, :elp3, :hgp, :total)';
			$statement = $db_conn->prepare($query);
			$statement->execute(array(
				':id' => $id,
				':ele1' => $marks[25],
				':ele1int' => $marks[26],
				':ele2' => $marks[39],
				':ele2int' => $marks[40],
				':ele3' => $marks[4],
				':ele3int' => $marks[5],
				':ele4' => $marks[32],
				':ele4int' => $marks[33],
				':ele5' => $marks[11],
				':ele5int' => $marks[12],
				':elp1' => $marks[62],
				':elp2' => $marks[55],
				':elp3' => $marks[48],
				':hgp' => $marks[69],
				':total' => ($marks[6] + $marks[13] + $marks[27] + $marks[41] + $marks[34] + $marks[48] + $marks[55] + $marks[62] + $marks[69])
			));
			echo "Last insert id: " . $db_conn->lastInsertId() . "<br />";
			
		 }	 
	}
?>