<?php

  include '../../config/connection.php';
  include 'authentication.php';


  if (isset($_GET['id'])&&isset($_GET['rA'])) {
    $id = $_GET['id'];
    $rA = $_GET['rA'];

    //echo "Clicked";
    $query = "UPDATE courses SET active='$rA' WHERE course_id=$id";

   $result = mysqli_query($db, $query) or die('Could not update active column: '.mysql_error());

  } else{
    echo "The delete button was not clicked";
  }

   header("Location: http://localhost/groupstart/views/instructor-courses.php");


?>
