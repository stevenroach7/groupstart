<?php
  // $course_id must be defined in the file this script is included in.
  // File this script is included in must be in views folder.
  // This script will initialize the $students array,
  // an array of associative arrays which hold student_id, and display_name.
  include '../config/connection.php';


  // For this course_id, get the students

  // Query students-courses table to find entries with course_id as the course_fk
  $get_students_courses = mysqli_query($db, "SELECT * FROM students_courses WHERE course_fk = '".$course_id."'");

  // Get instructor id's
  $student_ids = array();

  if (mysqli_num_rows($get_students_courses) > 0) {

      while($row = mysqli_fetch_assoc($get_students_courses)) {
        $student_ids[] = $row['student_fk'];
      }
  } 
    
  

  // Query students table to find students with student_id's and add to students array
  $students = array();
  foreach ($student_ids as $student_id) {

    $get_student = mysqli_query($db, "SELECT * FROM students WHERE student_id = '".$student_id."'");

    if (mysqli_num_rows($get_student) > 0) {
      // student_id's are unique so just one should be returned.

      $student_info = array();
      while ($row = mysqli_fetch_assoc($get_student)) {
        $student_info['student_id'] = $row['student_id'];
        $student_info['display_name'] = $row['display_name'];
        $student_info['name'] = $row['name'];
      }
      $students[] = $student_info;
    }
  }
//print_r($students);


 ?>
