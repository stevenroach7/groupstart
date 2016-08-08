<?php

  // Script to delete communication tool

  include '../../config/connection.php';


  $project_deliverable_id = $_GET['project_deliverable_id'];
  // Need these variables to redirect back to correct instructor-project page. 
  $project_id = $_GET['project_id'];
  $course_id = $_GET['course_id'];
  $pgid = $_GET['pgid'];

  $delete_deliverable = mysqli_query($db, "DELETE FROM project_deliverables WHERE project_deliverable_id = '$project_deliverable_id'");


  if (!$delete_deliverable) {
    // if data is not inserted into database return error
    die('Could not enter data given: '.mysqli_error($db));
  };

  header("Location: http://localhost/groupstart/views/instructor-project.php?project_id=$project_id&course_id=$course_id&pgid=$pgid");

 ?>
