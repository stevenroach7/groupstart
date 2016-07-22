
<html>
<head>
  <?php
    include 'features/authentication.php';
    include 'features/instructor-authentication.php';
    include 'features/banner.php';
    include 'features/instructor-get-courses-data.php'; // Gets $courses_data array.
  ?>

  <link rel="stylesheet" type="text/css" href="../css/style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">


  <script type="text/javascript" src="../js/accordion_functionality.js"></script>

  <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap core CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">



</head>
<body>
  <?php echo $banner  ?>


  <?php
    include '../config/connection.php';

    //Selecting all rows in Instructor_courses table
    $query = "SELECT * FROM instructors_courses";
    mysqli_query($db, $query) or die('Error querying database.');
  ?>

  <div class="container" id="instructor-course-list">
    <h1 style="text-align:center">List of Courses</h1>
    <!-- <h2 style="text-align:center">Welcome <?php echo $instructorInfo['name']?></h2><br> -->

    <div id='accordion'>

    <?php

       //echo $instructor_id;

    // Check if instructor is teaching courses or not
    if (empty($courses_data)) {
      echo '<h1>You are not currently teaching any courses.';

    } else {

      foreach ($courses_data as $course_data) {

        $course_id = $course_data['course_id'];
        $title = $course_data['title'];
        $description = $course_data['description'];
        $platform = $course_data['platform'];
        $subject_area = $course_data['subject_area'];
        $registration_code = $course_data['registration_code'];

        // For this course_id, get the instructors

        // For this course_id, get the students

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
            }
            $projects[] = $project_info;
        }


        echo "<h3>$title</h3>
          <div>
            <section id='course-decription'><h4>Course Description</h4>
              <p>$description</p>
              </section><br>
              <section id='course-projects'>
                  <h4>Course Projects</h4>
                  <div id='project-list'>
                      <ul class='list-group'>";
                      // Display projects
                      if (empty($projects)) {
                        echo "This course has no projects.";
                      } else {
                        foreach ($projects as $project) {
                          $title = $project['title'];
                          // TODO: use the project_id to pass the url
                          echo "<a href='instructor-project.php'><li class='list-group-item'>'$title'</li> </a>";
                        }
                      }
                echo "</ul>
                  </div>
            <br />
              <a href='instructor-add-project.php?course_id=$course_id&instructor_id=$instructor_id' class='btn btn-info' role='button' id='add-new-group'>Create New Project</a>
        </section>
        <br />

        <section id='student-course-list'>
            <h4>Students</h4>
            <div id='student-list'>
                <ul class='list-group'>
                    <li class='list-group-item'>Student 1</li>
                    <li class='list-group-item'>Student 2</li>
                    <li class='list-group-item'>Student 3</li>
                    <li class='list-group-item'>Student 4</li>
                    <li class='list-group-item'>Student 5</li>
                    <li class='list-group-item'>Student 6</li>
                </ul>
            </div>
        </section>
        <br />

        <b>Student registration code: '$registration_code'</b>

        <br><br>

        <a href=# class='btn btn-info' role='button' id='view-course-attachments'>View course attachments</a>

      </div>";
      }

    }
    ?>
  </div><br>
         <!-- <a href="instructor-add-course.php" class="btn btn-info" role="button" id="add-new-course">Add New Course</a> -->
        <!--button id="add-new-course" type="button" class="btn btn-default">Add New Course</button-->
    <a href="instructor-add-course.php" class="btn btn-info" role="button" id="add-new-course">Add New Course</a>
      </div>





</body>
</html>
