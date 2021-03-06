<?php
 // script to get courses student is enrolled in. This must be included from a page in the views directory.

// TODO: Handle errors

 include '../config/connection.php';
 include 'authentication.php';




 // Query students_courses table to get course id's
 $student_id = $_SESSION['student_id'];
 $get_courses = mysqli_query($db, "SELECT * FROM students_courses WHERE student_fk = '".$student_id."'");

   // Get course id of courses
 if (mysqli_num_rows($get_courses) > 0) {

     $course_ids = array();

     while($row = mysqli_fetch_assoc($get_courses)) {
       $course_ids[] = $row['course_fk'];
     }

     // Query courses table to get other course info for each course_id
     $courses_data = array();

     foreach ($course_ids as $course_id) {
       $get_course_info = mysqli_query($db, "SELECT * FROM courses WHERE course_id = '".$course_id."'");

       $course_info = array();
       // course_id is unique so there should be only one row returned.
       while($row = mysqli_fetch_assoc($get_course_info)) {
         $course_info['course_id'] = $row['course_id'];
         $course_info['title'] = $row['title'];
         $course_info['description'] = $row['description'];
         $course_info['platform'] = $row['platform'];
         $course_info['subject_area'] = $row['subject_area'];
         $course_info['active'] = $row['active'];
         
       }
       $courses_data[] = $course_info;
     }
 }


?>
