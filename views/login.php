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
     <?php echo $banner ?>
       <div class="jumbotron jumbotron-fluid" style="background-color:#d3d3d3 !important;margin-top:30px;">
         <div class="container">
                  <div class="row" id="webpage-description">
                      <div class="col-md-12">
                        <h1 style="text-align:center">Welcome to GroupStart</h1>
                            <p> <b>GroupStart</b> is an experimental, alpha-stage application that seeks to facilitate the early stages of an online group project.</p><br>
                           <h5 style="text-align:center" id="research-affil">University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5>
                      </div>
                  </div>
                  <div class="row" id="web-icons-area">
                    <div class="col-md-12">
                          <div id="web-rep-icons">
                            <img src="../img/multiple-users-silhouette.png" id="group-work"/>
                            <img src="../img/workers.png" id="group-formation"/>
                            <img src="../img/handshake.png" id="group-introduction"/><br>
                            <h3 style="margin-right:55px;"></h3><h3 style="margin-right:35px;">Group Work</h3><h3 style="margin-right:15px;">Group Formation</h3><h3>Group Introduction</h3></div>
              </div></div>
              </div>
              </div>
      <div class="container-fluid" id="home-page">
          <div class= "row" id="bottom-half">
              <div class="col-md-8 col-md-offset-2" id="su-buttons">
                <h3>Sign-in or Sign-up below!</h3>
    <button onclick="window.studentSignIn();" type="button" class="btn btn-primary" id="student-myBtn">Student</button>
    <button onclick="window.instructorSignIn();" type="button" class="btn" id="instructor-myBtn" style="background-color:#d3d3d3;">Instructor</button>
</div></div></div>

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
  </body>


</html>
