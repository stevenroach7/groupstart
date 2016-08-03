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
			
			if(count($students_id) > $minGroupsize){
				
				$shuffledStudents = knuth_shuffle($students);
				
				$avgGroupsize = round(($minGroupsize + $maxGroupsize) / 2);
				
				
				//divide shuffled array into equal chucks...last chunck may have differnt size
				$groups = array_chunk($students, $avgGroupsize); 
				
				//get last group of students to see if there's enough students in the group
				$lastGroup = end($groups); 
				$remStudents = count($lastGroup); //check how many gorups remain
				
				//if the number of remaining students is not equal to avg group size its not  a valid group yet
				
				if($remStudents != $avgGroupsize){
					
					array_pop($groups); //remove invalid group
					$groupSizes = array_map('count', $groups); //get size of each group formed;
					
					//checks that valid groups have sizes that are below max size
					if(max($groupSizes) != maxGroupsize){
						
						for($i = 0; $i < $remStudents; $i++){ //add each remaining student to a valid group
							array_push($groups[$i], $lastGroup[$i]);
							$remStudents--;
						}
						$groupSizes = array_map('count', $groups);
						
					} else{
						echo "A group has reached the maximum possible size. "; 
						
						if($remStudents != 0 ){
							echo "With the range given, we have created ". count($groups);
							$currGroupsizes = array_unique($groupSizes);
							$numGroupsizes = array_count_values($groupSizes);
							foreach($currGroupsizes as $key => $value){
								echo "there are " . $numGroupsizes[$values] . " groups with " . $value " students" . PHP_EOL;
							}
							echo "Increase the group size range";
						}
						
					}
				}
			
			} else{
				echo "There are not enough students to create a group";
			}
		} else{
			echo "There are not enough students to create a group";
		}
	
		
  
  
  
  
 



?>