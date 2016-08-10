<?php

  // Restart session here to help with testing.

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


  <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#d3d3d3;border-style: outset;">
    <div class="container"><a class="banner pull-left" href="index.php" style="text-align:left"><h1>GroupStart</h1></a></div>
  </nav><br>

 <div class="jumbotron jumbotron-fluid" id="index-page" style="background-color: #d3d3d3 !important">
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
                            <img src="img/multiple-users-silhouette.png" id="group-work"/>
                            <img src="img/workers.png" id="group-formation"/>
                            <img src="img/handshake.png" id="group-introduction"/><br>
                            <h3 style="margin-right:55px;"></h3><h3 style="margin-right:35px;">Group Work</h3><h3 style="margin-right:15px;">Group Formation</h3><h3>Group Introduction</h3></div>
              </div></div>
              </div>
     <a href="views/login.php" class="btn btn-info btn-lg center-block" role="button" id="get-started">Get Started</a>
</div>




</body>
</html>
