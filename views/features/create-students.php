<?php


  function create_students($n) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = 79; $x < $n; $x++) {

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

  //create_students(200);

  function create_students_for_course($n) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = 76; $x < $n; $x++) {

      $insert = "INSERT INTO `students_courses` (`student_course_id`, `student_fk`, `course_fk`) VALUES (NULL, '.$x.', '165')";

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
  //create_students_for_course(103);

  function create_students_for_project($n) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = 78; $x < $n; $x++) {

      $insert = "INSERT INTO `student_projects` (`student_project_id`, `student_fk`, `project_fk`) VALUES (NULL, '.$x.', '7')";

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
  //create_students_for_project(104);

 ?>
