<!-- Banner at the top of each page. Check if logged in and if not, redirect to login page. If so, show logout button-->
<?php
  // Require composer autoloader
  require(__DIR__ . '/../../vendor/autoload.php');

  use Auth0\SDK\Auth0;

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { // If session loggedin is set and logged in == true.
    // echo "You're in";
  } else {
    // echo "not logged in";
    // header('Location: http://localhost/groupstart/index.php'); // TODO: Figure out the logic here and test rigourously.
    // Kick them out
  }

  if (isset($_SESSION['type'])) {

    if ($_SESSION['type'] == 'student') {
      // echo "student";

      $auth0Students = new Auth0(array(
      'domain'        => 'groupstartstudents.auth0.com',
      'client_id'     => 'KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm',
      'client_secret' => 'I3EaB8zlG8-7oKohfL4r7ntfxYD_tWOReDkhcGQMVZcJau9KbJVaUAFcxo1XvnUC',
      'redirect_uri'  => 'http://localhost/groupstart/views/student-courses.php'
      ));

      $studentInfo = $auth0Students->getUser(); // Both of these call getUser, What is arrow syntax mean?

      if (!$studentInfo) {
        // Redirect to Login Page
        // echo "no student data";
      } else {
          // User is authenticated
          // Say hello to $userInfo['name']
          // print logout button
          // echo $studentInfo['user_id']; // Add instructor/student to database

      }

    } else { // type == instructor
      // echo "instructor";

      $auth0Instructors = new Auth0(array(
        'domain'        => 'groupstartinstructors.auth0.com',
        'client_id'     => '0Q8Sf2krAjcnTwmXO8CxoJ6qQd0JFNrb',
        'client_secret' => 'vP3PKAfgSTQ3b7FROEqo2x5aC2SIdQlxxFiGxDPiBpoPtgJC2dCuhYk4ZAiI4AQk',
        'redirect_uri'  => 'http://localhost/groupstart/views/instructor-courses.php'
      ));


      $instructorInfo = $auth0Instructors->getUser();

      if (!$instructorInfo) {
          // We have no user info
          // redirect to Login Page
      } else {
          // User is authenticated
          // Say hello to $userInfo['name']
          // print logout button
          // start sessions maybe
          // echo $instructorInfo['user_id'];
      }
    }
  } else {
    // echo "no Type";
  }


?>


<link rel="stylesheet" type="text/css" href="../css/style.css" />


<php

<?php
if (isset($_SESSION['type'])) { // Create redirect links for banner.
  if ($_SESSION['type'] == 'student') {
    $logo = '<a class="banner pull-left" href="student-courses.php" style="text-align:left"><h1>GroupStart</h1></a>';
  } else {
    $logo = '<a class="banner pull-left" href="instructor-courses.php" style="text-align:left"><h1>GroupStart</h1></a>';
  }
} else { // Test this
  $logo = '<a class="banner pull-left" href="login.php" style="text-align:left"><h1>GroupStart</h1></a>';
}

  $settings ='<a href="student-settings.php"><span class="glyphicon glyphicon-cog pull-right" style="font-size: 40px; margin-top:20px;"></span></a>';

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $logout = "<a href='features/logout.php'>Logout</a>";
  } else {
    $logout = "";
  }

  $banner = '<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">'.$logo.$settings.$logout.'</div></nav>';


  ?>


?>



</html>
