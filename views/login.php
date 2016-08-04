<?php

  // Require composer autoloader
  require(__DIR__ . '/../vendor/autoload.php');


  use Auth0\SDK\Auth0;

  $auth0Students = new Auth0(array(
    'domain'        => 'groupstartstudents.auth0.com',
    'client_id'     => 'KPiFueQyhPeAf8Gq1y0maxGbkThpG1fm',
    'client_secret' => 'I3EaB8zlG8-7oKohfL4r7ntfxYD_tWOReDkhcGQMVZcJau9KbJVaUAFcxo1XvnUC',
    'redirect_uri'  => 'http://localhost/groupstart/views/features/student-callback.php'
  ));

  $auth0Instructors = new Auth0(array(
    'domain'        => 'groupstartinstructors.auth0.com',
    'client_id'     => '0Q8Sf2krAjcnTwmXO8CxoJ6qQd0JFNrb',
    'client_secret' => 'vP3PKAfgSTQ3b7FROEqo2x5aC2SIdQlxxFiGxDPiBpoPtgJC2dCuhYk4ZAiI4AQk',
    'redirect_uri'  => 'http://localhost/groupstart/views/features/instructor-callback.php'
  ));

 ?>


<html>

  <?php include 'features/banner.php' ?>

  <head>
    <?php echo $banner ?>



      <!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script-->

      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

         <link rel="stylesheet" type="text/css" href="../css/style.css" />

      <script src="https://use.fontawesome.com/1439d65c28.js"></script>
      <!--script src="../js/modal.js"></script-->

  </head>


  <body>
      <div class="jumbotron jumbotron-fluid" style=background-color:#d3d3d3 !important;>
  <div class="container">
    <div class="row" id="top-half">
              <h1 style="text-align:center">Welcome to GroupStart</h1>
              <div class="col-md-12">
                  <div class="row" id="webpage-description">
                      <div class="col-md-12">
                            <p>
      <b>GroupStart</b> is an experimental, alpha-stage application that seeks to facilitate the early stages of an online group project.
    </p><br>
                           <h5 style="text-align:center" id="research-affil">University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5>
                      </div>
                  </div>
                  <div class="row" id="web-icons-area">
                    <div class="col-md-12">
                          <div id="web-rep-icons">
                          <i class="fa fa-users fa-5x" aria-hidden="true" id="group-work">
                          </i>
                          <i class="fa fa-cloud fa-5x" aria-hidden="true" id="idea-generation"></i>
                      <i class="fa fa-file-text-o fa-5x" aria-hidden="true" id="charter-formation"></i><br><h3>Group Work</h3><h3>Group Formation</h3><h3>Group Introduction</h3></div>
                  </div>

              </div>
              </div></div>
  </div>
</div>
      <div class="container-fluid" id="home-page">
          <div class= "row" id="bottom-half">
              <div class="col-md-12">
                  <div class="row" id="users-part">
              <div class="col-md-12">
                  <div class="row" id="sign-up-side">
                  <div class="col-md-12" id="sign-up-buttons" >
                      <div id="p0">
                      <h1 style="color:black;text-align:center">Get Started</h1>

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
          , callbackURL: 'http://localhost/groupstart/views/features/student-callback.php'
            ,icon: "../img/icon.png"
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
          , callbackURL: 'http://localhost/groupstart/views/features/instructor-callback.php'
            ,icon: "../img/icon.png"
          , responseType: 'code'
          , authParams: {
            scope: 'openid email'  // Learn about scopes: https://auth0.com/docs/scopes
          }
          , gravatar: false
        });
      }





    </script>
<div id="su-buttons">

    <button onclick="window.studentSignIn();" type="button" class="btn btn-primary" id="student-myBtn">Student</button>
    <button onclick="window.instructorSignIn();" type="button" class="btn" id="instructor-myBtn">Instructor</button>

                      </div>
                      </div>

                  </div>

              </div>

                  </div>
                  </div>
          </div>
      </div>










  </body>


</html>
