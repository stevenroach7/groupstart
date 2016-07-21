
<html>

  <head>

      <?php
        include 'features/authentication.php';
        include 'features/student-authentication.php';
        include 'features/banner.php';
        include 'features/student-get-courses-data.php'; // Gets $courses_data array.
      ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="../js/accordion_functionality.js"></script>

    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">


  </head>

  <body>
   <?php echo $banner ?>
   <?php
      // script to add course.
     include '../config/connection.php';


     // TODO: Figure out how to style validation alerts.

     if(isset($_POST['add_course_submit'])){

        if(empty($_POST['registration_code'])){

        } else {
          $registration_code = $_POST['registration_code'];

          // Check if registration code exists in courses.
          $check_registration_code = mysqli_query($db, "SELECT * FROM courses WHERE registration_code = '".$registration_code."'");


            // Get course id of course
          if (mysqli_num_rows($check_registration_code) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($check_registration_code)) {
              $course_id = $row["course_id"];
            }

            // get student_id from session storage
            $student_id = $_SESSION['student_id'];

            // Check if student is already in that course
            $check_exists = mysqli_query($db, "SELECT * FROM students_courses WHERE student_fk = '".$student_id."' AND course_fk = '".$course_id."'");
            $num_rows = mysqli_num_rows($check_exists);

            if ($num_rows !== 0) {
              echo "You are already registered for this course.";

            } else {

              // Add entry to student_courses table
              $add_course = "INSERT INTO `students_courses` (`student_course_id`, `student_fk`, `course_fk`) VALUES (NULL, '$student_id', '$course_id')";
              $retval = mysqli_query($db,$add_course);

              if(!$retval ) {
                die('Could not enter data: ' . mysqli_error($db));
                echo "Registration did not work.";
              }
              echo "You have been registered for this course.\n";
            }

          } else {
            echo "Registration code does not exist. Please try again.";
          }

        }
      };

    ?>


    <div class="container" id="instructor-course-list">
        <h1 style="text-align:center">List of Courses</h1>

    <div id='accordion'>
    <?php

    // Check if instructor is teaching courses or not
    if (empty($courses_data)) {
      echo "<h1>You are not currently enrolled in any courses.";
    } else {

      foreach ($courses_data as $course_data) {

        $course_id = $course_data['course_id'];
        $title = $course_data['title'];
        $description = $course_data['description'];
        $platform = $course_data['platform'];
        $subject_area = $course_data['subject_area'];



        echo "<h3>$title</h3>
          <div>
            <section id='course-decription'><h4>Course Description</h4>
              <p>$description</p>
              </section><br>
              <section id='course-projects'>
                  <h4>Course Projects</h4>
                  <div id='project-list'>
                      <ul class='list-group'>
                          <a href='student-start-project.php'><li class='list-group-item'>First item</li> </a>
                          <a href='student-start-project.php'><li class='list-group-item'>Second item</li></a>
                          <a href='student-start-project.php'><li class='list-group-item'>Third item</li></a>
                          <a href='student-start-project.php'><li class='list-group-item'>First item</li></a>
                          <a href='student-start-project.php'><li class='list-group-item'>Second item</li></a>
                          <a href='student-start-project.php'><li class='list-group-item'>Third item</li></a>
                      </ul>
                  </div>
              </section><br><br>


              <a href=# class='btn btn-info' role='button' id='view-course-attachments'>View course attachments</a>
              <a href='student-project.php' class='btn btn-info' style='float:right; width:300px;' role='button' id='view-student-group'>View My Group</a>

          </div>";
        }
    }
    ?>
    </div><br>

      <form method="POST" action="student-courses.php" id="add-course-student-form">
        <h4>Add New Course</h4>
        <input type="text" name="registration_code" placeholder="Enter Course Registration Code">
        <input type="submit" name="add_course_submit" value="Submit" form = "add-course-student-form">
      </form>
    </div>














  </body>
</html>
