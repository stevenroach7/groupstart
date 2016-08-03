
<html>

  <head>

      <?php
        include 'features/authentication.php';
        include 'features/student-authentication.php';
        include 'features/banner.php';
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


     include 'features/alert.php';


     if(isset($_POST['add_course_submit'])){

        if(empty($_POST['registration_code'])){

        } else {
          $registration_code = $_POST['registration_code'];

          // Check if registration code exists in courses.
          $check_registration_code = mysqli_query($db, "SELECT * FROM courses WHERE registration_code = '".$registration_code."'");


            // Get course id of course and if it is active or not
          if (mysqli_num_rows($check_registration_code) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($check_registration_code)) {
              $course_id = $row["course_id"];
              $active = $row["active"];
            };


            // get student_id from session storage
            $student_id = $_SESSION['student_id'];

            // Check if student is already in that course
            $check_exists = mysqli_query($db, "SELECT * FROM students_courses WHERE student_fk = '".$student_id."' AND course_fk = '".$course_id."'");
            $num_rows = mysqli_num_rows($check_exists);


            if ($num_rows !== 0) {

              alertUser("You are already registered for this course.");

            } elseif($active == 0){

              alertUser("This course is no longer active.");

            } else {

              // Add entry to student_courses table
              $add_course = "INSERT INTO `students_courses` (`student_course_id`, `student_fk`, `course_fk`) VALUES (NULL, '$student_id', '$course_id')";
              $retval = mysqli_query($db,$add_course);

              if(!$retval ) {
                die('Could not enter data: ' . mysqli_error($db));
              }
              alertUser("You have been registered for this course.");
            }

          } else {
            alertUser("Registration code does not exist. Please try again.");
          }

        }
      };



      // Script to get courses
      include 'features/student-get-courses-data.php'; // Gets $courses_data array.








    ?>


    <div class="container" id="instructor-course-list">
        <h1 style="text-align:center">List of Courses</h1>

    <div id='accordion'>
    <?php

    // Check if instructor is teaching courses or not
    if (empty($courses_data)) {
      echo "<h1>You are not currently enrolled in any courses.";
    } else {

      // Filter out inactive courses.
      $courses_data = array_filter($courses_data, function($v) { return $v['active'] == 1; });

      foreach ($courses_data as $course_data) {

        $course_id = $course_data['course_id'];
        $title = $course_data['title'];
        $description = $course_data['description'];
        $platform = $course_data['platform'];
        $subject_area = $course_data['subject_area'];


        // Get instructors that teach this course. $course_id must be defined above for this script.
        include 'features/get-instructors.php'; // Script will initialize $instructors array,
        // an array of associative arrays which hold instructor_id, and display_name.


        // TODO: Handle errors

        // For this course_id, get the projects

        // Query projects table to find projects with course_id as the course_fk
        $get_projects = mysqli_query($db, "SELECT * FROM projects WHERE course_fk = '".$course_id."'");

        $projects = array();
          // Get course id of courses
        if (mysqli_num_rows($get_projects) > 0) {

            $project_info = array();
            while($row = mysqli_fetch_assoc($get_projects)) {
              $project_info['project_id'] = $row['project_id'];
              $project_info['title'] = $row['title'];
              $projects[] = $project_info;
            }
        }

        // Display Title
        echo "<h3>$title</h3>
          <div>";


        if (count($instructors) > 1) {
          $instructor_label = 'Instructors:';
        } else {
          $instructor_label = 'Instructor:';
        }

        // Display instructors
        echo "<section id='course-decription'><h4><label>$instructor_label</label> ";

        // for loop so we can put commas after all names except for the last one.
        for ($x = 0; $x < count($instructors); $x++) {
        // foreach ($instructors as $instructor) {

          $display_name = $instructors[$x]['display_name'];
          echo "$display_name";

          if ($x !== count($instructors) - 1) { // Add comma and space for all entries but last.
            echo ", ";
          }


        }
        echo"</h4></section>";

        echo "<section><h4 class='course-val'><label>Platform:</label> $platform</h4>";

        echo "<h4 class='pull-right' class='course-val'><label>Subject Area:</label> $subject_area</h4></section>";


        // Display course description
        echo "<section id='course-decription'><h4><label>Course Description</label></h4>
          <p>$description</p>
          </section><br>
          <section id='course-projects'>
              <h4><label>Course Projects</label></h4>
              <div id='project-list'>
                  <ul class='list-group'>";
                  // Display projects
                  if (empty($projects)) {
                    echo "This course has no projects.";
                  } else {
                    foreach ($projects as $project) {
                      $title = $project['title'];
                      $project_id = $project['project_id'];

                      echo "<li class='list-group-item clearfix'>$title";

                      // If student has not started project, show start project button.
                      // Else - If student has group, show View Group Button, Else show notification saying you'll get a group soon.
                      // TODO: Test this.

                      // Query student_projects table to find if student has started project
                      $get_student_projects = mysqli_query($db, "SELECT * FROM student_projects WHERE student_fk = '".$student_id."' AND project_fk = '".$project_id."'");

                      if (mysqli_num_rows($get_student_projects) > 0) {

                        // Check if student is in group. Need to see if student has a project group and then make sure that project group is for this project.
                        $in_group = 0; // Initialize boolean specifying if student is in group as false.
                        $get_project_group_students = mysqli_query($db, "SELECT * FROM project_group_students WHERE student_fk = '".$student_id."'");

                        if (mysqli_num_rows($get_project_group_students) > 0) {

                          while($row = mysqli_fetch_assoc($get_project_group_students)) {
                            $project_group_id = $row['project_group_fk'];

                            // Check that group is for this project.
                            $get_project_group = mysqli_query($db, "SELECT * FROM project_group WHERE project_group_id = '".$project_group_id."' AND project_fk = '".$project_id."'");

                            if (mysqli_num_rows($get_project_group) > 0) {
                              $in_group = 1;
                              break;
                            }
                          }
                        }

                        if ($in_group) {
                          // TODO: Pass project id through url
                          echo "<span class='pull-right'> <a href='student-project.php' class='btn btn-info' id='view-student-group'>View My Group</a></span></li> ";

                        } else {
                          echo "<span class='pull-right'> You will be placed in a group soon.</span></li> ";
                        }
                      } else { // Student has not started project
                        echo "<span class='pull-right'> <a href='student-start-project.php?project_id=$project_id&course_id=$course_id' class='btn btn-info' id='start-project'>Start Project</a></span></li> ";

                      }
                    }
                  }
            echo "</ul>
              </div>
          </section><br><br>


          <a href='features/download.php?id=$course_id&type=course' class='btn btn-info' role='button' id='view-course-attachments'>Download Course Attachments</a>

        </div>";
        }
    }
    ?>
    </div><br>

      <form method="POST" action="student-courses.php" id="add-course-student-form">
        <h4>Add New Course</h4>
        <input type="text" name="registration_code" placeholder="Enter Course Registration Code">
        <input type="submit" name="add_course_submit" value="Submit" form = "add-course-student-form">
        <!-- TODO: Refresh page after user presses submit so new courses show up. -->
      </form>
    </div>

  </body>
</html>
