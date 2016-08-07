<?php

    include '../config/connection.php';
    

    $project_id = $_GET['project_id'];
    $course_id = $_GET['course_id'];
    $pgid = $_GET['pgid'];

    echo $pgid;

    $max_group_size = $_GET['max'];
    $min_group_size = $_GET['min'];

    $query = "UPDATE projects SET max_group_size = $max_group_size, min_group_size = $min_group_size WHERE project_id = $project_id";

    $retval = mysqli_query($db, $query);

    if (!$retval) {
        die('Could not update projects table: '.mysql_error());
    };

    
    header('Location: http://localhost/groupstart/views/instructor-project.php?project_id='.$project_id.'&course_id='.$course_id.'&pgid='.$pgid);

?>