<?php
	
	 include '../../config/connection.php';

	//The modern Durstenfeld-Knuth algorithm
	//source: https://www.rosettacode.org/wiki/Knuth_shuffle#PHP
	
	function knuth_shuffle(&$arr){
		for($i=count($arr)-1;$i>0;$i--){
			$rnd = mt_rand(0,$i);
			list($arr[$i], $arr[$rnd]) = array($arr[$rnd], $arr[$i]);
		}
		return $arr;
	};
	
		//TODO: case where min == max

		$project_id = $_GET['id'];
		$course_id = $_GET['cid'];
		
		$group_sizerange = mysqli_query($db,"SELECT max_group_size, min_group_size FROM projects WHERE project_id = $project_id");
		
		
		if(!$group_sizerange){
			die('Could not get data: ' . mysql_error());
		};
		
		$maxGroupsize = $minGroupsize = "";
		
		while($row = mysqli_fetch_assoc($group_sizerange)){
			$maxGroupsize = $row['max_group_size'];
			$minGroupsize = $row['min_group_size'];
		};
		
		//echo $maxGroupsize . PHP_EOL;
		//echo $minGroupsize . PHP_EOL;
		
		
		$get_students = mysqli_query($db,"SELECT student_fk FROM student_projects WHERE project_fk = $project_id");
	
		
		if(mysqli_num_rows($get_students) > 0){
			
			$students_id = array();
			
			while($row = mysqli_fetch_assoc($get_students)){
				$students_id[] = $row['student_fk'];
			};
			
			//print_r($students_id) . PHP_EOL;
			//echo count($students_id) . PHP_EOL;
			
			if(count($students_id) > $minGroupsize){
				
				$shuffledStudents = knuth_shuffle($students_id);
				
				$avgGroupsize = round(($minGroupsize + $maxGroupsize) / 2);
				
				
				//divide shuffled array into equal chucks...last chunck may have differnt size
				$groups = array_chunk($shuffledStudents, $avgGroupsize); 
				
				/*echo "<pre>\n";
				print_r($groups);
				echo "</pre>";*/
				
				//get last group of students to see if there's enough students in the group
				$lastGroup = end($groups); 
				$remStudents = count($lastGroup); //check how many gorups remain
				
				//if the number of remaining students is not equal to avg group size its not  a valid group yet
				
				if($remStudents != $avgGroupsize){
					
					array_pop($groups); //remove invalid group
					$groupSizes = array_map('count', $groups); //get size of each group formed;
					
					//checks that valid groups have sizes that are below max size
					if(max($groupSizes) != $maxGroupsize){
						
						for($i = 0; $i < $remStudents+1; $i++){ //add each remaining student to a valid group
							array_push($groups[$i], $lastGroup[$i]);
							
							$remStudents--;
						}
						$groupSizes = array_map('count', $groups);
						
					} else{
						echo "A group has reached the maximum possible size. "; 
						
						if($remStudents != 0 ){ //if there are still students not in a group
							echo "<h4> With the range given, we have created ". count($groups) . "</h4><br>";
							$currGroupsizes = array_unique($groupSizes);
							$numGroupsizes = array_count_values($groupSizes);
							foreach($currGroupsizes as $key => $value){
								echo "<h4> There are " . $numGroupsizes[$value] . " groups with " . $value . " students" . "</h4><br>";
							};
							echo "Increase the group size range." . PHP_EOL;
							
							echo "<pre>\n";
							print_r($groups);
							echo "</pre>";
							
							echo "<pre>\n";
							print_r($groupSizes);
							echo "</pre>";
							
							//redirect to instructor-create-project
							//header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id);
						}
						
					}
				}
				echo "everything went fine" . PHP_EOL;
			
				echo "<pre>\n";
				print_r($groups);
				echo "</pre>";
				
				echo "<pre>\n";
				print_r($groupSizes);
				echo "</pre>";
				
				$checkgroups = mysqli_query($db, "SELECT project_fk FROM project_group WHERE project_fk = '.$project_id.'");
				
				if(mysqli_num_rows($checkgroups) > 0){
					//echo "groups already exist for this project" .PHP_EOL;
					//then update table
					
					$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
					
					$project_group_ids = array();
					
					while($row = mysqli_fetch_assoc($get_project_group_ids)){
						$project_group_ids[] = $row['project_group_id'];
					}
					//print_r($project_group_ids);
					$values = implode(", ",$project_group_ids);
					
					$listValues = "(" .$values .")";
					
					//echo $listValues;
					
					$delete2 = "DELETE FROM project_group_students WHERE project_group_fk IN $listValues";
					
					$retval2 = mysqli_query($db, $delete2); // performing mysql query
					
					if (!$retval2) {
						// if data is not inserted into database return error
						die('Could not delete students: '.mysqli_error($db));
					} else{
						//echo "students have been deleted";
					}
					
					//delete old groups first
					$delete = "DELETE FROM project_group WHERE project_fk = '$project_id'";
					
					$retval = mysqli_query($db, $delete); // performing mysql query
					
					if (!$retval) {
						// if data is not inserted into database return error
						die('Could not delete entries: '.mysqli_error($db));
					} else{
						//echo "groups have been deleted";
					}
					
					//double check if either one of delete query failed...if first delete fails then stop process
					
					
					
					
					//then add new fromed groups
					
					//update project_group table
					for($i=0; $i < count($groups); $i++){
						$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
						$retval = mysqli_query($db, $insert); // performing mysql query
						
						if (!$retval) {
							// if data is not inserted into database return error
							die('Could not groups data given: '.mysqli_error($db));
						};
					}
					
					//update project_group_student table
					
					$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
					
					$project_group_ids = array();
					
					while($row = mysqli_fetch_assoc($get_project_group_ids)){
						$project_group_ids[] = $row['project_group_id'];
					}
					
					foreach($groups as $group => $members){
						
						$project_group_fk = $project_group_ids[$group];
						
						foreach($members as $member => $student){
							//echo $student . PHP_EOL;
							
							$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
							
							$retval = mysqli_query($db, $insert); // performing mysql query
							
							if (!$retval) {
								// if data is not inserted into database return error
								die('Could not enter students given: '.mysqli_error($db));
							};
							
						}
					}
					
					
				} else {
					//groups have not already been formed for this project so insert
					//echo "groups have not already been formed for this project";
					
				
					
					for($i=0; $i < count($groups); $i++){
						$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
						$retval = mysqli_query($db, $insert); // performing mysql query
						
						if (!$retval) {
							// if data is not inserted into database return error
							die('Could not enter data given: '.mysqli_error($db));
						};
					};
					
					$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
					
					$project_group_ids = array();
					
					while($row = mysqli_fetch_assoc($get_project_group_ids)){
						$project_group_ids[] = $row['project_group_id'];
					}
					
					//insert into project_group_students_table
					foreach($groups as $group => $members){
						
						$project_group_fk = $project_group_ids[$group];
						
						foreach($members as $member => $student){
							//echo $student . PHP_EOL;
							
							$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
							
							$retval = mysqli_query($db, $insert); // performing mysql query
							
							if (!$retval) {
								// if data is not inserted into database return error
								die('Could not enter data given: '.mysqli_error($db));
							};
							
						}
					}
				}
				
				//double check if either one of insert fail...if first insert fail then stop process
						
				
				
				
				
				
			
				
				
				
				
				
				
				//header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id);
			
			} else{
				echo "There are not enough students to create a group";
				//header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id);
			}
		} else{
			echo "There are not enough students to create a group";
			//header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id);
		}
	
		
  
  
  
  
 



?>