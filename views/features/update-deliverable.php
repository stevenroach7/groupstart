<?php

  include '../../config/connection.php';

  $project_deliverable_id = $_GET['deliverable_id'];
  $project_group_id = $_GET['project_group_id'];
  $index = $_GET['index'];

  $submit_name = 'submit-deliverable'.$index;

  if (isset($_POST[$submit_name])) {
    $text_name = 'deliverable-text'.$index;
    $submission_text = $_POST[$text_name];
    echo $submission_text;

    $update_submission = mysqli_query($db, "UPDATE project_group_project_deliverables SET submission_text = '$submission_text' WHERE project_group_fk='$project_group_id' AND project_deliverables_fk='$project_deliverable_id'");


    if (!$update_submission) {
      echo mysqli_error($db);
    } else {
      header("Location: http://localhost/groupstart/views/student-project.php?project_group_id=$project_group_id");
    }

  }





 ?>
