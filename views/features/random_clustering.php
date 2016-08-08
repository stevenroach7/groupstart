<html>
	<head>
		<?php 
			include 'authentication.php';
	 		include 'instructor-authentication.php';
     		include 'groupformbanner.php';
		?>
			
		
		<!-- Latest compiled and minified CSS -->
			
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
		
	<body>
		<?php echo $banner?><br>
		
		
	</body>
		
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
				
				$avgGroupsize = intval(($minGroupsize + $maxGroupsize) / 2);
				
				
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
						
						//do database connection
							
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
									//if this delete fails then stop process
									die('Could not delete students: '.mysqli_error($db));
								} else{
									//else, students have been deleted now you can delete entires in project_group 
									//now delete old groups first
									
									$delete = "DELETE FROM project_group WHERE project_fk = '$project_id'";
									
									$retval = mysqli_query($db, $delete); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not delete entries: '.mysqli_error($db));
									} else{
										//echo "groups have been deleted";
									}
								}
								
								
								//NEXT update tables with the newly formed groups
								
								
								//first update project_group table with new groups
								for($i=0; $i < count($groups); $i++){
									
									$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not insert groups data given: '.mysqli_error($db));
									};
								}
								
								
								//second update project_group_student table with students in each group
								
								$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
								
								if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
									
									//if statement is making sure that last insert worked properly
									//if all entires were inserted then continue process of updating project_group_student table with students in each group
									$project_group_ids = array();
									
									while($row = mysqli_fetch_assoc($get_project_group_ids)){
										$project_group_ids[] = $row['project_group_id'];
									}
									
									foreach($groups as $group => $members){
										
										$project_group_fk = $project_group_ids[$group];
										
										foreach($members as $member => $student){
											//for each student in each group insert an entry into project_group_students
											$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
											
											$retval = mysqli_query($db, $insert); // performing mysql query
											
											if (!$retval) {
												// if data is not inserted into database return error
												die('Could not enter students given: '.mysqli_error($db));
											};
										}
									}
								} else{
									echo "Entires were not properly inserted in project_group table" . PHP_EOL;
								}
							
							} else {
								//groups have not already been formed for this project so insert
								//echo "groups have not already been formed for this project";
								
								
								//first insert new groups into project_group table
								for($i=0; $i < count($groups); $i++){
									
									$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not enter data given: '.mysqli_error($db));
									};
								};
								
								
								//second insert students in each group into project_group_students table
								$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
								
								if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
									//if statement is making sure that last insert worked properly
									//if all entires were inserted then continue process of updating project_group_student table with students in each group
									
									$project_group_ids = array();
									
									while($row = mysqli_fetch_assoc($get_project_group_ids)){
										$project_group_ids[] = $row['project_group_id'];
									}
									
									
									foreach($groups as $group => $members){
										
										$project_group_fk = $project_group_ids[$group];
										
										foreach($members as $member => $student){
											//for each student in each group insert an entry into project_group_students
											
											$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
											
											$retval = mysqli_query($db, $insert); // performing mysql query
											
											if (!$retval){
												// if data is not inserted into database return error
												die('Could not enter students given: '.mysqli_error($db));
											
											};
										}
									}
								} else{
									echo "Entires were not properly inserted in project_group table" . PHP_EOL;
								}
							}
						
						$pgid = implode("_fk",$project_group_ids);
						
						header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid='.$pgid);//ADD OTHER VAR
						
					} else{
						
						if($remStudents != 0 ){
							
							//if there are still students not in a group
							//echo "someting went wrong!" . PHP_EOL;
							
							echo "<div class='row' style='text-align:center;'><div class = 'col-md-8 col-md-offset-2'>";
							echo "<h4>There is a total of ". count($students_id)." students who have signed up for this project. </h4><br>" . PHP_EOL;
							
							$currGroupsizes = array_unique($groupSizes);
							$numGroupsizes = array_count_values($groupSizes);
							foreach($currGroupsizes as $key => $value){
								echo "<h4> With the range given, we have created " . $numGroupsizes[$value] . " groups with " . $value . " students. </h4><br>" .PHP_EOL;
							};
							
							
							if($remStudents > 1){
								echo "<h4>There are ". $remStudents." students not in a group </h4><br>" . PHP_EOL;
							} else{
								echo "<h4>There is". $remStudents." student not in a group </h4><br>" . PHP_EOL;
							}
							
							if($maxGroupsize === $minGroupsize){
								echo "<h4>Consider changing the group size range. If you want groups to all have the same size then change minimum and maximum group size so that it is a divisor of the total number of students in the project.</h4><br>";
							} else{
								echo "<h4>Consider increasing the group size range.</h4><br>" . PHP_EOL;
							}
							
							echo "<div class='alert alert-success'>You will be redirected to this project's page in 20 seconds to make the necessary changes as you see fit.</div>";
							
							
							/*echo "<pre>\n";
							print_r($groups);
							echo "</pre>";
							
							echo "<pre>\n";
							print_r($groupSizes);
							echo "</pre>";
							*/
							
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
									//if this delete fails then stop process
									die('Could not delete students: '.mysqli_error($db));
								} else{
									//else, students have been deleted now you can delete entires in project_group 
									//now delete old groups first
									
									$delete = "DELETE FROM project_group WHERE project_fk = '$project_id'";
									
									$retval = mysqli_query($db, $delete); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not delete entries: '.mysqli_error($db));
									} else{
										//echo "groups have been deleted";
									}
								}
								
								
								//NEXT update tables with the newly formed groups
								
								
								//first update project_group table with new groups
								//print_r($lastGroup);
								
								//$groups = array_push($groups, $lastGroup); //add last group to group
								$groups[count($groups)] = $lastGroup;
								
							
								
							
								
								for($i=0; $i < count($groups); $i++){
									
									$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not insert groups data given: '.mysqli_error($db));
									};
								}
								
								
								//second update project_group_student table with students in each group
								
								$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
								
								if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
									
									
									//if statement is making sure that last insert worked properly
									//if all entires were inserted then continue process of updating project_group_student table with students in each group
									$project_group_ids = array();
									
									while($row = mysqli_fetch_assoc($get_project_group_ids)){
										$project_group_ids[] = $row['project_group_id'];
									}
									
									foreach($groups as $group => $members){
										
										$project_group_fk = $project_group_ids[$group];
										
										foreach($members as $member => $student){
											//for each student in each group insert an entry into project_group_students
											$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
											
											$retval = mysqli_query($db, $insert); // performing mysql query
											
											if (!$retval) {
												// if data is not inserted into database return error
												die('Could not enter students given: '.mysqli_error($db));
											};
										}
									}
								} else{
									echo "Entires were not properly inserted in project_group table" . PHP_EOL;
								}
							
							} else {
								//groups have not already been formed for this project so insert
								//echo "groups have not already been formed for this project";
								
								
								//first insert new groups into project_group table
								for($i=0; $i < count($groups); $i++){
									
									$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not enter data given: '.mysqli_error($db));
									};
								};
								
								
								//second insert students in each group into project_group_students table
								$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
								
								if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
									//if statement is making sure that last insert worked properly
									//if all entires were inserted then continue process of updating project_group_student table with students in each group
									
									$project_group_ids = array();
									
									while($row = mysqli_fetch_assoc($get_project_group_ids)){
										$project_group_ids[] = $row['project_group_id'];
									}
									
									
									foreach($groups as $group => $members){
										
										$project_group_fk = $project_group_ids[$group];
										
										foreach($members as $member => $student){
											//for each student in each group insert an entry into project_group_students
											
											$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
											
											$retval = mysqli_query($db, $insert); // performing mysql query
											
											if (!$retval){
												// if data is not inserted into database return error
												die('Could not enter students given: '.mysqli_error($db));
											
											};
										}
									}
								} else{
									echo "Entires were not properly inserted in project_group table" . PHP_EOL;
								}
							}
						
						$pgid = implode("_fk",$project_group_ids);
							//redirect to instructor-create-project
							
							
							$url = 'http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid='.$pgid;
							
							header('refresh:20; url='.$url);
							
						
							echo "</div></div>";
						} else{
							
							//do database connection
							
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
									//if this delete fails then stop process
									die('Could not delete students: '.mysqli_error($db));
								} else{
									//else, students have been deleted now you can delete entires in project_group 
									//now delete old groups first
									
									$delete = "DELETE FROM project_group WHERE project_fk = '$project_id'";
									
									$retval = mysqli_query($db, $delete); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not delete entries: '.mysqli_error($db));
									} else{
										//echo "groups have been deleted";
									}
								}
								
								
								//NEXT update tables with the newly formed groups
								
								
								//first update project_group table with new groups
								for($i=0; $i < count($groups); $i++){
									
									$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not insert groups data given: '.mysqli_error($db));
									};
								}
								
								
								//second update project_group_student table with students in each group
								
								$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
								
								if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
									
									//if statement is making sure that last insert worked properly
									//if all entires were inserted then continue process of updating project_group_student table with students in each group
									$project_group_ids = array();
									
									while($row = mysqli_fetch_assoc($get_project_group_ids)){
										$project_group_ids[] = $row['project_group_id'];
									}
									
									foreach($groups as $group => $members){
										
										$project_group_fk = $project_group_ids[$group];
										
										foreach($members as $member => $student){
											//for each student in each group insert an entry into project_group_students
											$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
											
											$retval = mysqli_query($db, $insert); // performing mysql query
											
											if (!$retval) {
												// if data is not inserted into database return error
												die('Could not enter students given: '.mysqli_error($db));
											};
										}
									}
								} else{
									echo "Entires were not properly inserted in project_group table" . PHP_EOL;
								}
							
							} else {
								//groups have not already been formed for this project so insert
								//echo "groups have not already been formed for this project";
								
								
								//first insert new groups into project_group table
								for($i=0; $i < count($groups); $i++){
									
									$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval) {
										// if data is not inserted into database return error
										die('Could not enter data given: '.mysqli_error($db));
									};
								};
								
								
								//second insert students in each group into project_group_students table
								$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
								
								if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
									//if statement is making sure that last insert worked properly
									//if all entires were inserted then continue process of updating project_group_student table with students in each group
									
									$project_group_ids = array();
									
									while($row = mysqli_fetch_assoc($get_project_group_ids)){
										$project_group_ids[] = $row['project_group_id'];
									}
									
									
									foreach($groups as $group => $members){
										
										$project_group_fk = $project_group_ids[$group];
										
										foreach($members as $member => $student){
											//for each student in each group insert an entry into project_group_students
											
											$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
											
											$retval = mysqli_query($db, $insert); // performing mysql query
											
											if (!$retval){
												// if data is not inserted into database return error
												die('Could not enter students given: '.mysqli_error($db));
											
											};
										}
									}
								} else{
									echo "Entires were not properly inserted in project_group table" . PHP_EOL;
								}
							}
							$pgid = implode("_fk",$project_group_ids);
						
						header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid='.$pgid);//ADD OTHER VAR
						}
						
					}
				} else{
					
					//do database connection
					
					echo "everything went fine and there were no remaining students" . PHP_EOL;
					
					
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
					
						if (!$retval2){
							//if this delete fails then stop process
							die('Could not delete students: '.mysqli_error($db));
						} else{
							//else, students have been deleted now you can delete entires in project_group 
							//now delete old groups first
							
							$delete = "DELETE FROM project_group WHERE project_fk = '$project_id'";
							$retval = mysqli_query($db, $delete); // performing mysql query
							
							if (!$retval) {
								// if data is not inserted into database return error
								die('Could not delete entries: '.mysqli_error($db));
							} else{
								//echo "groups have been deleted";
							}
						}
						
						//NEXT update tables with the newly formed groups
						
						//first update project_group table with new groups
						for($i=0; $i < count($groups); $i++){
							$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
							$retval = mysqli_query($db, $insert); // performing mysql query
							if (!$retval) {
								// if data is not inserted into database return error
								die('Could not insert groups data given: '.mysqli_error($db));
							};
						}
						
						//second update project_group_student table with students in each group
						
						$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
						
						if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
							
							//if statement is making sure that last insert worked properly
							//if all entires were inserted then continue process of updating project_group_student table with students in each group
							
							$project_group_ids = array();
							
							while($row = mysqli_fetch_assoc($get_project_group_ids)){
								$project_group_ids[] = $row['project_group_id'];
							}
							
							foreach($groups as $group => $members){
								$project_group_fk = $project_group_ids[$group];
								foreach($members as $member => $student){
									//for each student in each group insert an entry into project_group_students
									$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
									
									$retval = mysqli_query($db, $insert); // performing mysql query
									
									if (!$retval){
										// if data is not inserted into database return error
										die('Could not enter students given: '.mysqli_error($db));
									};
								}
							}
						} else{
							echo "Entires were not properly inserted in project_group table" . PHP_EOL;
						}
					
					} else {
						
						//groups have not already been formed for this project so insert
						//echo "groups have not already been formed for this project";
						
						
						//first insert new groups into project_group table
						
						
						for($i=0; $i < count($groups); $i++){
							$insert = "INSERT INTO project_group (project_group_id, project_fk) VALUES (NULL, '.$project_id.')";
							$retval = mysqli_query($db, $insert); // performing mysql query
							
							if (!$retval) {
								// if data is not inserted into database return error
								die('Could not enter data given: '.mysqli_error($db));
							};
						};
						
						//second insert students in each group into project_group_students table
						
						$get_project_group_ids = mysqli_query($db,"SELECT project_group_id FROM project_group WHERE project_fk = '.$project_id.'");
						
						if(mysqli_num_rows($get_project_group_ids) == count($groups)) {
							
							//if statement is making sure that last insert worked properly
							//if all entires were inserted then continue process of updating project_group_student table with students in each group
							
							$project_group_ids = array();
							
							while($row = mysqli_fetch_assoc($get_project_group_ids)){
								$project_group_ids[] = $row['project_group_id'];
							}
							
							foreach($groups as $group => $members){
								$project_group_fk = $project_group_ids[$group];
								foreach($members as $member => $student){
									//for each student in each group insert an entry into project_group_students
									$insert = "INSERT INTO project_group_students (project_group_students_id, project_group_fk, student_fk) VALUES (NULL,'.$project_group_fk.','.$student.') ";
									
									$retval = mysqli_query($db, $insert); // performing mysql query
									if (!$retval){
										// if data is not inserted into database return error
										die('Could not enter students given: '.mysqli_error($db));
									};
								}
							}
						} else{
							echo "Entires were not properly inserted in project_group table" . PHP_EOL;
						}
					}
					$pgid = implode("_fk",$project_group_ids);
					
					header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid='.$pgid);//ADD OTHER VAR
				}
			} else{
				
				//echo "There are not enough students to create a group";
				echo "<div class='row' style='text-align:center;'><div class = 'col-md-8 col-md-offset-2'>";
				echo "<div class='alert alert-success'>There are not enough students to create a group. You will be redirected to this project's page in 20 seconds.</div>";
				
				$url = 'http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid=none';
				
				header('refresh:20; url='.$url);
				
				echo "</div></div>";
					
			
			}
		} else{
			
			echo "<div class='row' style='text-align:center;'><div class = 'col-md-8 col-md-offset-2'>";
			echo "<div class='alert alert-success'>There are not enough students to create a group. You will be redirected to this project's page in 20 seconds.</div>";
			
			$url = 'http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid=none';
			
			header('refresh:20; url='.$url);
			
			echo "</div></div>";
			
		}
	
	?>
	
</html>