<?php

?>


<html>


  <head>
    <?php
      include 'features/authentication.php';
      include 'features/student-authentication.php';
      include 'features/banner.php'
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css" />

  </head>

  <body>
      <?php echo $banner ?>




      <h1>Group Introduction</h1>
      <form action="" method="POST" id="group-intro">
        <p>You will be placed in a group shortly. Please explain you motivation for taking this course and what interests you about this project. This will be displayed to your fellow group members.</p>
        <input type="text" name="motivation">
        <br />
        <br />
        <p>Please check the following group expectations you would like to see your group have. Your preferences will be used to create a shared group expectations display. </p>
        <input type="checkbox" name="expectation" value="consensus"> Consensus Decisions <br />
        <input type="checkbox" name="expectation" value="honest"> Be Honest with group members <br />
        <input type="checkbox" name="expectation" value="work"> Complete agreed upon work <br />
        <input type="checkbox" name="expectation" value="progress"> Inform others of progress <br />

        <br />
        <p>Want to add a different group expectation? No worries, you may add new expectations in the group page after the group has been formed.</p>









  </body>
</html>
