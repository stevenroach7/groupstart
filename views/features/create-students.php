<?php


  function create_students($n, $start) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = $start; $x < $start + $n; $x++) {

      // Make fake data
      $auth0_id = $x.date('Y-m-d H:i:s'); // This variable must be unique. Use Datetime to achieve this.
      $email = $x.'@gmail.com';
      $name = 'student'.$x;

      $insert = "INSERT INTO `students` (`student_id`, `auth0_id`, `email`, `registration_time`, `name`, `display_name`)
      VALUES ('$x', '$auth0_id', '$email', CURRENT_TIMESTAMP, '$name', '$name')";

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


  function create_students_for_course($n, $start, $course_id) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = $start; $x < $start + $n; $x++) {

      $insert = "INSERT INTO `students_courses` (`student_course_id`, `student_fk`, `course_fk`) VALUES (NULL, '$x.', '$course_id')";

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

  function create_students_for_project($n, $start, $project_id) {

    include '../../config/connection.php';
    $success = 1; // boolean holding if insert is successful

    // Repeat n times
    for ($x = $start; $x < $start + $n; $x++) {

      echo $x;

      // $insert = "INSERT INTO `student_projects` (`student_project_id`, `student_fk`, `project_fk`) VALUES (NULL, '.$x.', '$project_id')";
      $insert = "INSERT INTO `student_projects` (`student_project_id`, `student_fk`, `project_fk`, `motivation`, `work`, `inform`, `messages`, `progress`, `consensus`, `diversity`, `honest`, `active`, `trust`, `respect`)
      VALUES (NULL, '$x', '$project_id', 'I want to learn about user interfaces.', 1, 0, 0, 1, 0, 1, 0, 1, 0, 1)";

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


    function create_fake_students($n, $start, $course_id, $project_id) {
      create_students($n, $start);
      create_students_for_course($n, $start, $course_id);
      create_students_for_project($n, $start, $project_id);

    }



    create_fake_students(100, 968, 178, 20);

 ?>
