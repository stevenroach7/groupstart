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
      <?php

        // Script to submit group introduction form.

        include '../config/connection.php';

        $project_id = $_GET['project_id'];
        $student_id = $_SESSION['student_id'];

        if (isset($_POST['submit'])) {

          // gather variables from form
          $motivation = $_POST['motivation'];

            if (empty($motivation)) { // Make sure user has entered motivation
            echo 'Please enter a motivation for taking this course.';
            } else {

              // initialize all expectations in array as 0.
              $expectations = array('work' => 0, 'inform' => 0, 'messages' => 0, 'progress' => 0, 'consensus' => 0, 'diversity' => 0, 'honest' => 0, 'active' => 0, 'trust' => 0, 'respect' => 0);

              // Loop through checked expectations.
              foreach ($_POST['expectations'] as $val) {

                // Change value in expectations array if expectation is checked.
                foreach ($expectations as $expectation => $bool) {
                  if ($val == $expectation) {
                      $expectations[$expectation] = 1;
                  }
                }
              }

              // Insert into student_projects.
              $insert = "INSERT INTO `student_projects` (`student_project_id`, `student_fk`, `project_fk`, `motivation`, `work`, `inform`, `messages`, `progress`, `consensus`, `diversity`, `honest`, `active`, `trust`, `respect`)
              VALUES (NULL, '$student_id', '$project_id', '$motivation', $expectations[work], $expectations[inform], $expectations[messages], $expectations[progress], $expectations[consensus], $expectations[diversity], $expectations[honest], $expectations[active], $expectations[trust], $expectations[respect])";

              $retval = mysqli_query($db, $insert); // performing mysql query

              if (!$retval) {
                // if data is not inserted into database return error
                die('Could not enter data given: '.mysqli_error($db));
              };
              
              header('Location: http://localhost/groupstart/views/student-courses.php');
            }
          }
       ?>


      <div class="container">
        <h1>Group Introduction</h1>
        <form action="" method="POST" id="group-intro">
          <h4>You will be placed in a group shortly. Please explain your motivation for taking this course and what interests you about this project. This will be displayed to your fellow group members.</h4>
          <input type="text" name="motivation" maxlength="400">
          <br />
          <br />
          <h4>Please check the following group expectations you would like to see your group have. Your preferences will be used to create a shared group expectations display. </h4>
          <p>
          <input type="checkbox" name="expectations[]" value="work"> Complete agreed upon work on time<br />
          <input type="checkbox" name="expectations[]" value="inform"> Inform of non-completion<br />
          <input type="checkbox" name="expectations[]" value="messages"> Read and respond to messages within agreed time<br />
          <input type="checkbox" name="expectations[]" value="progress"> Inform others of progress <br />
          <input type="checkbox" name="expectations[]" value="consensus"> Respect consensus decisions <br />
          <input type="checkbox" name="expectations[]" value="diversity"> Value diversity <br />
          <input type="checkbox" name="expectations[]" value="honest"> Be honest <br />
          <input type="checkbox" name="expectations[]" value="active"> Play an active part in team <br />
          <input type="checkbox" name="expectations[]" value="trust"> Trust each other <br />
          <input type="checkbox" name="expectations[]" value="respect"> Respect each other <br />
        </p>

          <!-- Ground Rules - Ground Rules in Team Projects: Findings from a Prototype System to Support Students - Janice Whatley
          https://www.researchgate.net/publication/220590647_Ground_Rules_in_Team_Projects_Findings_from_a_Prototype_System_to_Support_Students?enrichId=rgreq-9e56d7ab880c09573b4b8f548665190b-XXX&enrichSource=Y292ZXJQYWdlOzIyMDU5MDY0NztBUzo5ODQ4OTQ1MTE1NTQ2MkAxNDAwNDkzMTIzODM0&el=1_x_3
          • Complete agreed work on time
          • Inform of non-completion
          • Read and respond to messages within agreed time
          • Inform others of progress
          • Respect consensus decisions
          • Value diversity
          • Be honest
          • Play an active part in the team
          • Trust each other
          • Respect each other
          • Attend meetings that have been arranged
          • Prepare for meetings
          • Be punctual for meetings
          • Send apologies if unable to attend
          -->

          <label>Want to add a different group expectation? No worries, you may add new expectations in the group page after the group has been formed.</label> <br />
          <br />
          <input type="submit" name="submit" value="Submit" class="btn btn-info" form="group-intro" id="group-intro-submit"/>

        </form>
      </div>








  </body>
</html>
