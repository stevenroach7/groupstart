<?php

  // Require composer autoloader
  require(__DIR__ . '/../vendor/autoload.php');


  use Auth0\SDK\Auth0;


  $auth0Instructors = new Auth0(array(
    'domain'        => 'grouplens.auth0.com',
    'client_id'     => 'JRm23mco7fQ8ShKjH7ibaLMT568bWaKP',
    'client_secret' => 'uNnsAh5D4VRzT09rSTCJB27kbhqtmCJcPPmxKBCGfNbe_2uMTZA_b6sFMgMKhfcu',
    'redirect_uri'  => 'http://localhost/groupstart/views/instructor-courses.php'
  ));


 ?>


<html>

  <?php include 'features/banner.php' ?>

  <head>
    <?php echo $banner ?>
    <h1>Welcome to GroupStart</h1>
  </head>


  <body>

    <p>
      GroupStart is an experimental, alpha-stage application
       that seeks to facilitate the early stages of an online group project.
    </p>
    <h5>University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5>


    <script src="https://cdn.auth0.com/js/lock-9.1.min.js"></script>
    <script type="text/javascript">

      var studentLock = new Auth0Lock('bCtvXMfHvtJH650uSGQ0K6N1RjPGK0RW', 'grouplens.auth0.com');


      function studentSignIn() {
        studentLock.show({
          dict: {
            signin: {
              title: "Student Log in"
            }
          , signup: {
              title: "Student Sign Up"
            }
          }
          , callbackURL: 'http://localhost/groupstart/views/student-courses.php'
          , responseType: 'code'
          , authParams: {
            scope: 'openid email'  // Learn about scopes: https://auth0.com/docs/scopes
          }
          , gravatar: false
        });
      }


      var instructorLock = new Auth0Lock('JRm23mco7fQ8ShKjH7ibaLMT568bWaKP', 'grouplens.auth0.com');

      function instructorSignIn() {
        instructorLock.show({
          dict: {
            signin: {
              title: "Instructor Log in"
            }
          , signup: {
              title: "Instructor Sign Up"
            }
          }
          , callbackURL: 'http://localhost/groupstart/views/instructor-courses.php'
          , responseType: 'code'
          , authParams: {
            scope: 'openid email'  // Learn about scopes: https://auth0.com/docs/scopes
          }
          , gravatar: false
        });
      }

    </script>

    <button onclick="window.studentSignIn();">Students</button>
    <button onclick="window.instructorSignIn();">Instructors</button>





  </body>


</html>
