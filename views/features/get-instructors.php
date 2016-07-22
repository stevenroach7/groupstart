<?php
  // $course_id must be defined in the file this script is included in.
  // File this script is included in must be in views folder.
  // This script will initialize the $instructors array,
  // an array of associative arrays which hold instructor_id, and display_name.


  // For this course_id, get the instructors

  // Query instructors-courses table to find entries with course_id as the course_fk
  $get_instructors_courses = mysqli_query($db, "SELECT * FROM instructors_courses WHERE course_fk = '".$course_id."'");

  // Get instructor id's
  $instructor_ids = array();

  if (mysqli_num_rows($get_instructors_courses) > 0) {

      while($row = mysqli_fetch_assoc($get_instructors_courses)) {
        $instructor_ids[] = $row['instructor_fk'];
      }
  }

  // Query instructors table to find instructors with instructor id's and add to instructors array
  $instructors = array();
  foreach ($instructor_ids as $instructor_id) {

    $get_instructor = mysqli_query($db, "SELECT * FROM instructors WHERE instructor_id = '".$instructor_id."'");

    if (mysqli_num_rows($get_instructor) > 0) {
      // instructor_id's are unique so just one should be returned.

      $instructor_info = array();
      while ($row = mysqli_fetch_assoc($get_instructor)) {
        $instructor_info['instructor_id'] = $row['instructor_id'];
        $instructor_info['display_name'] = $row['display_name'];
      }
      $instructors[] = $instructor_info;
    }
  }


 ?>
