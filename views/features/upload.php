<?php


  if (!empty($_FILES)) {

    include '../../config/connection.php';

    $targetDir = "../../uploads/";
    $fileName = $_FILES['file']['name'];
    $targetFile = $targetDir.$fileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){

        $file = $_FILES['file']['tmp_name'];
        $course_id = NULL;
        $project_id = NULL;
        $project_deliverable_id = NULL;
        $project_example_id = NULL;
        $project_group_project_deliverable_id = NULL;
        $project_option_id = NULL;


        //insert file into attachments table
        // $upload_file = "INSERT INTO attachments (attachment_id, file, course_fk, project_fk, project_deliverable_fk, project_example_fk, project_group_project_deliverable_fk, project_option_fk)
        // VALUES (NULL, '$file', '$course_id', '$project_id', '$project_deliverable_id', '$project_example_id', '$project_group_project_deliverable_id', '$project_option_id')";

        $upload_file = "INSERT INTO attachments (attachment_id, file, course_fk, project_fk, project_deliverable_fk, project_example_fk, project_group_project_deliverable_fk, project_option_fk)
        VALUES (NULL, '$file', NULL, NULL, NULL, NULL, NULL, NULL)";

        $retval = mysqli_query($db, $upload_file);

        if (!$retval) {
            echo mysql_error();
            die('Could not enter data given: '.mysql_error());
        }

    }

  }
?>
