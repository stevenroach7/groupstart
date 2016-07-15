<?php

  // header('Refresh: 0; URL=views/login.php');
  // Unset all of the session variables.
  if (!session_status() == PHP_SESSION_NONE) {
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
  }

  session_start();
  $_SESSION['loggedin'] = false;


 ?>


<html>

  <head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

         <link rel="stylesheet" type="text/css" href="css/style.css" />

      <script src="https://use.fontawesome.com/1439d65c28.js"></script>
</head>


<body>

 <div class="jumbotron jumbotron-fluid" id="index-page" style="background-color: #d3d3d3 !important">
  <div class="container">
    <div class="row" id="top-half">
              <h1 style="text-align:center">Welcome to GroupStart</h1>
              <div class="col-md-12">
                  <div class="row" id="webpage-description">
                      <div class="col-md-12">
                            <p>
      <b>GroupStart</b> is an experimental, alpha-stage application that seeks to facilitate the early stages of an online group project.
    </p>
                           <h5 style="text-align:center" id="research-affil">University of Minnesota Twin Cities - Computer Science &amp; Engineering - GroupLens Research</h5><br>
                      </div>
                  </div>
                  <div class="row" id="web-icons-area">
                      <div class="col-md-12">
                          <div id="web-rep-icons">
                          <i class="fa fa-users fa-5x" aria-hidden="true" id="group-work">
                          </i>
                          <i class="fa fa-cloud fa-5x" aria-hidden="true" id="idea-generation"></i>
                      <i class="fa fa-file-text-o fa-5x" aria-hidden="true" id="charter-formation"></i><br><h3>Group Work</h3><h3>Idea Formation</h3><h3>Charter Creation</h3></div>
                  </div>

              </div>
              </div></div>
  </div>
     <a href="views/login.php" class="btn btn-info btn-lg center-block" role="button" id="get-started">Get Started</a>
</div>







  <!--form action="../php_scripts/upload.php" class="dropzone"></form-->



</body>
</html>
