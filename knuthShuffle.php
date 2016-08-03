<?php
 
//The modern Durstenfeld-Knuth algorithm
function knuth_shuffle(&$arr){
	for($i=count($arr)-1;$i>0;$i--){
		$rnd = mt_rand(0,$i);
		list($arr[$i], $arr[$rnd]) = array($arr[$rnd], $arr[$i]);
	}
	return $arr;
}


//$arr = [2, 4, 5, 12, 45, 72, 1, 5, 75, 8, 44, 0, 13];
//$shuffled = knuth_shuffle($arr);
//print_r($shuffled);


function randomCluster($students){ //get array of students unique id from db
	
	$shuffledStudents = knuth_shuffle($students);
	
	
	$minGroupsize = 3; //get this value from db
	$maxGroupsize = 5; //get this value from db
	$avgGroupsize = round(($minGroupsize + $maxGroupsize) / 2);
	
	//divide shuffled array into equal chucks...last chunck may have differnt size
	$groups = array_chunk($students, $avgGroupsize); 
	
	$lastGroup = end($groups); //get last group of students to see if its a valid group
	$remStudents = count($lastGroup); //check how many gorups remain
	
	
	//if the number of remaining students is not equal to avg group size its not  a valid group yet
	if($remStudents != $avgGroupsize){
		
		array_pop($groups); //remove invalid group
		$groupSizes = array_map('count', $groups); //get size of each group formed;
		
		if(max($groupSizes) != maxGroupsize){ //checks that valids groups have sizes that are below max size
			
			for($i = 0; $i < $remStudents; $i++){ //add each remaining student to a valid group
				array_push($groups[$i], $lastGroup[$i]);
				$remStudents--;
			}
			
			$groupSizes = array_map('count', $groups);
			
		} else{
			echo "a group has reached the maximum possible size"; //don't think we'll ever get to this case but...
		}
	}
	
	print_r($groups);
	
}


$arr = range(0, 108);
randomCluster($arr);

?>