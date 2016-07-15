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
      // redirect to Login Page
    header('Location: http://localhost/groupstart/views/features/logout.php');
  } else {
      // User is authenticated
      // Redirect to instructor homepage
      header('Location: http://localhost/groupstart/views/instructor-courses.php');
  }

?>
