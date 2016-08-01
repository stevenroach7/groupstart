<?php

  include 'authentication.php';

  // We checked to make sure session type was student or instructor in authentication.php
  // so we just need to check if they are an instructor trying to access a student page.
  if ($_SESSION['type'] == 'instructor') {
    // Redirect to instructor home page
    header('Location: http://localhost/groupstart/views/instructor-courses.php');

  }




 ?>
