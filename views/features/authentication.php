<?php
  // Require composer autoloader
  require(__DIR__ . '/../../vendor/autoload.php');

  use Auth0\SDK\Auth0;

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  // TODO: Rigorously test logic on this page.

  if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { // If session loggedin is set and logged in == true.
    // Redirect to login page.
    header('Location: http://localhost/groupstart/views/login.php');
  }

  if (isset($_SESSION['type'])) {

    if ($_SESSION['type'] == 'student') {

      $auth0Students = new Auth0(array(
      'domain'        => 'groupstartstudents.auth0.com',
      'client_id'     => 'KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm',
      'client_secret' => 'I3EaB8zlG8-7oKohfL4r7ntfxYD_tWOReDkhcGQMVZcJau9KbJVaUAFcxo1XvnUC',
      'redirect_uri'  => 'http://localhost/groupstart/views/features/student-callback.php'
      ));

      $studentInfo = $auth0Students->getUser();

      if (!$studentInfo) {
        // No student data so log them out.
        header('Location: http://localhost/groupstart/views/features/logout.php');
      }

    } else { // type == instructor

      $auth0Instructors = new Auth0(array(
        'domain'        => 'groupstartinstructors.auth0.com',
        'client_id'     => '0Q8Sf2krAjcnTwmXO8CxoJ6qQd0JFNrb',
        'client_secret' => 'vP3PKAfgSTQ3b7FROEqo2x5aC2SIdQlxxFiGxDPiBpoPtgJC2dCuhYk4ZAiI4AQk',
        'redirect_uri'  => 'http://localhost/groupstart/views/features/instructor-callback.php'
      ));


      $instructorInfo = $auth0Instructors->getUser();

      if (!$instructorInfo) {
        // No instructor data so log them out.
        header('Location: http://localhost/groupstart/views/features/logout.php');
      }
    }

  } else { // No Session type variable so redirect to logout page. 
    header('Location: http://localhost/groupstart/views/features/logout.php');
  }


?>
