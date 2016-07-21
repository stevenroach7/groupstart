<?php


  // Require composer autoloader
  require(__DIR__ . '/../../vendor/autoload.php');

  use Auth0\SDK\Auth0;

  session_start();

  $_SESSION['loggedin'] = true;
  $_SESSION['type'] = 'instructor';

  $auth0Instructors = new Auth0(array(
    'domain'        => 'groupstartinstructors.auth0.com',
    'client_id'     => '0Q8Sf2krAjcnTwmXO8CxoJ6qQd0JFNrb',
    'client_secret' => 'vP3PKAfgSTQ3b7FROEqo2x5aC2SIdQlxxFiGxDPiBpoPtgJC2dCuhYk4ZAiI4AQk',
    'redirect_uri'  => 'http://localhost/groupstart/views/features/instructor-callback.php'
  ));


  $instructorInfo = $auth0Instructors->getUser();

  if (!$instructorInfo) {
      // We have no user info
      // Log user out
    header('Location: http://localhost/groupstart/views/features/logout.php');
  } else {
    // User is authenticated with Auth0. Now we add info to MySQL database.
    include '../../config/connection.php';


    // Get user info from Auth0 profile.
    $name = $instructorInfo['name'];
    $auth0_id = $instructorInfo['user_id'];

    if (isset($instructorInfo['email'])) { // Email might not be set if user logs in with Facebook.
      $email = $instructorInfo['email'];
    } else {
      $email = '';
    }

    // Store auth0_id in Session.
    $_SESSION['user_id'] = $auth0_id; // TODO: Possibly remove this.

    // Check if user is in database based off of Auth0-userID
    // Create query and number of rows returned from query.
    $check_exists = mysqli_query($db, "SELECT * FROM instructors WHERE auth0_id = '".$auth0_id."'");
    $num_rows = mysqli_num_rows($check_exists);

    if ($num_rows != 0) { // There already exists an entry in instructors with the same auth0_id.
      echo"user already exists";
    } else { // auth0_id does not exist yet in instructors table.
      echo "Need to register you.";
      //insert query goes here
      $register = "INSERT INTO `instructors` (`instructor_id`, `auth0_id`, `email`, `registration_time`, `name`, `display_name`)
      VALUES (NULL, '$auth0_id', '$email', CURRENT_TIMESTAMP, '$name', 'name')";

      if ($db->query($register) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $register . "<br>" . $db->error;
        header('Location: http://localhost/groupstart/views/features/logout.php'); // Error so log user out so they can try again.
      }
    }



    // Redirect to instructor homepage
    header('Location: http://localhost/groupstart/views/instructor-courses.php'); // Comment this line out to test if database insert logic is correct.
  }

?>
