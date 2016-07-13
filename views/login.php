<?php

  // Require composer autoloader
  require(__DIR__ . '/../vendor/autoload.php');


  use Auth0\SDK\Auth0;

  $auth0Students = new Auth0(array(
    'domain'        => 'groupstartstudents.auth0.com',
    'client_id'     => 'KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm',
    'client_secret' => 'I3EaB8zlG8-7oKohfL4r7ntfxYD_tWOReDkhcGQMVZcJau9KbJVaUAFcxo1XvnUC',
    'redirect_uri'  => 'http://localhost/groupstart/views/student-courses.php'
  ));

  $auth0Instructors = new Auth0(array(
    'domain'        => 'groupstartinstructors.auth0.com',
    'client_id'     => '0Q8Sf2krAjcnTwmXO8CxoJ6qQd0JFNrb',
    'client_secret' => 'vP3PKAfgSTQ3b7FROEqo2x5aC2SIdQlxxFiGxDPiBpoPtgJC2dCuhYk4ZAiI4AQk',
    'redirect_uri'  => 'http://localhost/groupstart/views/instructor-courses.php'
  ));


 ?>


<html>

  <?php include 'features/banner.php' ?>

  <head>
    <?php echo $banner ?>
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      
      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      
      
      <link rel="stylesheet" type="text/css" href="../css/style.css" />
      
      <script src="https://use.fontawesome.com/1439d65c28.js"></script>
      
  </head>


  <body>
      <div class="container">
          <h1 style="text-align:center">Welcome to GroupStart</h1><br>
          <div class="row">
              <div class="col-md-12">
                  <div class="row" id="webpage-description">
                      <div class="col-md-12">
                            <p style="text-align:center">
      <b>GroupStart</b> is an experimental, alpha-stage application that seeks to facilitate the early stages of an online group project.
    </p>
                           <h5 style="text-align:center" id="research-affil">University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5>
                      </div>
                  </div>
                  <div class="row" id="web-icons-area">
                      <div class="col-md-12">
                          <div id="web-rep-icons">
                          <i class="fa fa-users fa-5x" aria-hidden="true" id="group-work">
                          </i>
                          <i class="fa fa-cloud fa-5x" aria-hidden="true" id="idea-generation"></i>
                      <i class="fa fa-file-text-o fa-5x" aria-hidden="true" id="charter-formation"></i></div>
                  </div>
              
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6"></div>
                  </div>
                  </div>
          </div>
      </div>

   


    <script src="https://cdn.auth0.com/js/lock-9.1.min.js"></script>
    <script type="text/javascript">

      var studentLock = new Auth0Lock('KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm', 'groupstartstudents.auth0.com');



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


        var instructorLock = new Auth0Lock('0Q8Sf2krAjcnTwmXO8CxoJ6qQd0JFNrb', 'groupstartinstructors.auth0.com');

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
