<?php


  function create_students($n) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = 0; $x < $n; $x++) {

      // Make fake data
      $auth0_id = $x.date('Y-m-d H:i:s'); // This variable must be unique. Use Datetime to achieve this.
      $email = $x.'@gmail.com';
      $name = 'student'.$x;

      $insert = "INSERT INTO `students` (`student_id`, `auth0_id`, `email`, `registration_time`, `name`, `display_name`)
      VALUES (NULL, '$auth0_id', '$email', CURRENT_TIMESTAMP, '$name', '$name')";

      $retval = mysqli_query($db, $insert);

      if (!$retval) { // Failed insert. Break out of loop
        echo mysqli_error($db);
        $success = 0;
        break;
      }
    }
    if ($success) {
      echo 'Success';
    }

  }

  create_students(100);

 ?>
