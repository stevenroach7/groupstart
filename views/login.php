<?php

  // Require composer autoloader
  require(__DIR__ . '/../vendor/autoload.php');

use Auth0\SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => 'grouplens.auth0.com',
    'client_id'     => 'bCtvXMfHvtJH650uSGQ0K6N1RjPGK0RW',
    'client_secret' => 'NpHPjNmtZjQQVnGeQvbbdRqwdAcit3KutB4RM0XoqO_K5Pgr1mK0DG0XRK3IaL15',
    'redirect_uri'  => 'http://localhost/groupstart/views/student-courses.php'
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

    <div class="sign-up">
      <h2>Sign Up</h2>
      <a href="#student-sign-up"><button>Student</button></a>
      <a href="#instructor-sign-up"><button>Instructor</button></a>
    </div>



    <div id="student-sign-up" class="modal-dialog">
      <div>
  		  <a href="#close" title="Close" class="close">close</a>
  		  <h2>Student Sign Up</h2>
        <form method="post" action="login.php">
          <p><input type="text" name="first-name" placeholder="First Name">
            <input type="text" name="last-name" placeholder="Last Name"></p>
          <p><input type="text" name="email" maxlength="255" placeholder="Email"></p>
          <p><input type="text" name="password" maxlength="32" placeholder="Password"></p>
          <p><input type="text" name="confirm-password" maxlength="32" placeholder="Confirm Password"></p>
          <p><input type="radio" name="age-range" value="18-">0-18
            <input type="radio" name="age-range" value="19-29">19-29
            <input type="radio" name="age-range" value="30-39">30-39
            <input type="radio" name="age-range" value="40-49">40-49
            <input type="radio" name="age-range" value="50-59">50-59
            <input type="radio" name="age-range" value="60+">60+
          </p>
          <p>
            <?php include 'features/timezones.php' ?>
          </p>
          <p><input type="submit" name="sign-up" value="Sign Up"></p>

        </form>
  	  </div>
    </div>

    <div id="instructor-sign-up" class="modal-dialog">
      <div>
  		  <a href="#close" title="Close" class="close">close</a>
  		  <h2>Instructor Sign Up</h2>
        <form method="post" action="login.php">
          <p><input type="text" name="first-name" placeholder="First Name">
            <input type="text" name="last-name" placeholder="Last Name">
          </p>
          <p><input type="text" name="display-name" maxlength="255" placeholder="Preferred Display Name"></p>
          <p><input type="text" name="email" maxlength="255" placeholder="Email"></p>
          <p><input type="text" name="password" maxlength="32" placeholder="Password"></p>
          <p><input type="text" name="confirm-password" maxlength="32" placeholder="Confirm Password"></p>
          <p>
            <?php include 'features/timezones.php' ?>
          </p>
          <p><input type="submit" name="sign-up" value="Sign Up"></p>
        </form>
  	  </div>
    </div>

    <div class="sign-in">
      <h2>Sign In</h2>
      <form method="post" action="login.php">
        <p><input type="radio" name="account-type" value="student">Student
          <input type="radio" name="account-type" value="instructor">Instructor</p>
        <p><input type="text" name="email" maxlength="255" placeholder="Email"></p>
        <p><input type="text" name="password" maxlength="32" placeholder="Password"></p>
        <p><input type="submit" name="sign-in" value="Sign In"></p>
      </form>

    </div>
    <a href="student-courses.php">Student Courses</a>
    <a href="instructor-courses.php">Instructor Courses</a>

    <script src="https://cdn.auth0.com/js/lock-9.1.min.js"></script>
    <script type="text/javascript">

      var lock = new Auth0Lock('bCtvXMfHvtJH650uSGQ0K6N1RjPGK0RW', 'grouplens.auth0.com');


      function signin() {
        lock.show({
            callbackURL: 'http://localhost/groupstart/views/student-courses.php'
          , responseType: 'code'
          , authParams: {
            scope: 'openid email'  // Learn about scopes: https://auth0.com/docs/scopes
          }
          , gravatar: false
        });
      }







    </script>
    <button onclick="window.signin();">Login</button>

  </body>


</html>
