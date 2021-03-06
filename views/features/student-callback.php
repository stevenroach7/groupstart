<?php


  // Require composer autoloader
  require(__DIR__ . '/../../vendor/autoload.php');

  use Auth0\SDK\Auth0;

  session_start();

  $_SESSION['loggedin'] = true;
  $_SESSION['type'] = 'student';

  $auth0Students = new Auth0(array(
  'domain'        => 'groupstartstudents.auth0.com',
  'client_id'     => 'KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm',
  'client_secret' => 'I3EaB8zlG8-7oKohfL4r7ntfxYD_tWOReDkhcGQMVZcJau9KbJVaUAFcxo1XvnUC',
  'redirect_uri'  => 'http://localhost/groupstart/views/features/student-callback.php'
  ));

  $studentInfo = $auth0Students->getUser();

  if (!$studentInfo) {
    // Log user out
    header('Location: http://localhost/groupstart/views/features/logout.php');
  } else {
    // User is authenticated with Auth0. Now we add info to MySQL database.
    include '../../config/connection.php';


    // Get user info from Auth0 profile.
    $name = $studentInfo['name'];
    $auth0_id = $studentInfo['user_id'];

    if (isset($studentInfo['email'])) { // Email might not be set if user logs in with Facebook.
      $email = $studentInfo['email'];
    } else {
      $email = '';
    }

    // Store auth0_id in Session.
    $_SESSION['user_id'] = $auth0_id; // TODO: Possibly remove this.
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;

    // Check if user is in database based off of Auth0-userID
    // Create query and number of rows returned from query.
    $check_exists = mysqli_query($db, "SELECT * FROM students WHERE auth0_id = '".$auth0_id."'");
    $num_rows = mysqli_num_rows($check_exists);

    if ($num_rows != 0) { // There already exists an entry in students with the same auth0_id.
      echo"user already exists";
    } else { // auth0_id does not exist yet in students table.
      echo "Need to register you.";
      //insert query goes here
      $register = "INSERT INTO `students` (`student_id`, `auth0_id`, `email`, `registration_time`, `name`, `display_name`)
      VALUES (NULL, '$auth0_id', '$email', CURRENT_TIMESTAMP, '$name', '$name')";

      if ($db->query($register) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $register . "<br>" . $db->error;
        header('Location: http://localhost/groupstart/views/features/logout.php'); // Error so log user out so they can try again.
      }
    }


    // Add student_id and display name to session storage.
    $get_student = mysqli_query($db, "SELECT * FROM students WHERE auth0_id = '".$auth0_id."'");

      // Get course id of course
    if (mysqli_num_rows($get_student) > 0) {
        // auth0_id is unique in database so this will return 1 or 0 results.
        while($row = mysqli_fetch_assoc($get_student)) {
          $student_id = $row['student_id'];
          $display_name = $row['display_name'];
        }
        $_SESSION['student_id'] = $student_id;
        $_SESSION['display_name'] = $display_name;

    } else { // 0 results are returned so there must be an error.
      header('Location: http://localhost/groupstart/views/features/logout.php'); // Error so log user out so they can try again.
    }


    // Redirect to student homepage
    header('Location: http://localhost/groupstart/views/student-courses.php'); // Comment this line out to test if database insert logic is correct.
  }





?>
