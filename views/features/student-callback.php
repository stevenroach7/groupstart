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
    // Redirect to Login Page
    // echo "no student data";
    header('Location: http://localhost/groupstart/views/features/logout.php');
  } else {
    // User is authenticated
    // Redirect to student homepage
    header('Location: http://localhost/groupstart/views/student-courses.php');
  }





?>
