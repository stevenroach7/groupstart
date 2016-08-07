<?php
  // Script to add vote for an expectation


  include '../../config/connection.php';



  $student_id = $_GET['student_id'];
  $project_id = $_GET['project_id'];
  $project_group_id = $_GET['project_group_id'];
  $expectation = $_GET['expectation'];


  // The combination of student and project_id is unique so only one result should be updated.
  $update_expectation = mysqli_query($db, "UPDATE student_projects SET $expectation=1 WHERE student_fk='$student_id' AND project_fk='$project_id'");

  if (!$update_expectation) {
    echo mysqli_error($db);
  }

  header("Location: http://localhost/groupstart/views/student-project.php?project_group_id=$project_group_id");




 ?>
