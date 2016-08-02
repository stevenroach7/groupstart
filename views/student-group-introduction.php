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
        <h1>Group Introduction</h1><br>
        <form action="" method="POST" id="group-intro">

          <div id="group-intro-content">
            <h3>You will be placed in a group shortly. Please explain your motivation for taking this course and what interests you about this project. This will be displayed to your fellow group members.</h3>
            <input type="text" name="motivation" maxlength="400" id="motivation-input">
            <br />
            <h3>Please check the following group expectations you would like to see your group have. Your preferences will be used to create a shared group expectations display. </h3>
            <p>
            <input type="checkbox" name="expectations[]" value="work" id="c1" class="css-check"> <label class="expect-label" for="c1"><span></span>Complete agreed upon work on time</label><br />
            <input type="checkbox" name="expectations[]" value="inform" id="c2" class="css-check"><label class="expect-label" for="c2"><span></span> Inform of non-completion</label><br />
            <input type="checkbox" name="expectations[]" value="messages" id="c3" class="css-check"><label class="expect-label" for="c3"><span></span> Read and respond to messages within agreed time</label><br />
            <input type="checkbox" name="expectations[]" value="progress" id="c4" class="css-check"><label class="expect-label" for="c4"><span></span> Inform others of progress</label> <br />
            <input type="checkbox" name="expectations[]" value="consensus" id="c5" class="css-check"><label class="expect-label" for="c5"><span></span> Respect consensus decisions</label> <br />
            <input type="checkbox" name="expectations[]" value="diversity" id="c6" class="css-check"><label class="expect-label" for="c6"><span></span> Value diversity</label> <br />
            <input type="checkbox" name="expectations[]" value="honest" id="c7" class="css-check"><label class="expect-label" for="c7"><span></span> Be honest</label> <br />
            <input type="checkbox" name="expectations[]" value="active" id="c8" class="css-check"><label class="expect-label" for="c8"><span></span> Play an active part in team</label> <br />
            <input type="checkbox" name="expectations[]" value="trust" id="c9" class="css-check"><label class="expect-label" for="c9"><span></span> Trust each other</label> <br />
            <input type="checkbox" name="expectations[]" value="respect" id="c10" class="css-check"><label class="expect-label" for="c10"><span></span> Respect each other</label> <br />
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
            <input type="submit" name="submit" value="Submit" class="btn btn-primary" style="margin-left:30px;" form="group-intro" id="group-intro-submit"/>
          </div>
          <!-- <input type="submit" name="submit" value="Submit" class="btn btn-info" form="group-intro" id="group-intro-submit"/> -->

        </form>
      </div>








  </body>
</html>
