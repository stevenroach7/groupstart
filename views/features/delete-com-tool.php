<?php

  // Script to delete communication tool

  include '../../config/connection.php';


  $communication_id = $_GET['communication_id'];
  $project_group_id = $_GET['project_group_id'];


  $delete_com = mysqli_query($db, "DELETE FROM communications WHERE communication_id = '$communication_id'");


  if (!$delete_com) {
    // if data is not inserted into database return error
    die('Could not enter data given: '.mysqli_error($db));
  };



  header("Location: http://localhost/groupstart/views/student-project.php?project_group_id=$project_group_id");



 ?>
