
<html>
<head>
  <?php
    include 'features/authentication.php';
    include 'features/instructor-authentication.php';
    include 'features/banner.php';
  ?>

  <link rel="stylesheet" type="text/css" href="../css/style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">


  <script type="text/javascript" src="../js/accordion_functionality.js"></script>
  <script type="text/javascript" src="../js/instructor-course.js"></script>

  <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

  <!-- Bootstrap core CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">



</head>
<body>
  <?php echo $banner  ?>


  <?php
    include '../config/connection.php';

    // Script to get courses
    include 'features/instructor-get-courses-data.php'; // Gets $courses_data array.


  ?>

  <div class="container" id="instructor-course-list">
    <h1 style="text-align:center">List of Courses</h1><br>
    <h4><?php echo $instructorInfo['name'] ?></h4><br>

    <div id='accordion'>

    <?php

       //echo $instructor_id;

    // Check if instructor is teaching courses or not
    if (empty($courses_data)) {
      echo '<h1>You are not currently teaching any courses.';

    } else {

    //filter courses that are not active
      $courses_data = array_filter($courses_data, function($v) { return $v['active'] == 1; });

    //print_r($courses_data);

      foreach ($courses_data as $course_data) {

        $course_id = $course_data['course_id'];
        $title = $course_data['title'];
        $description = $course_data['description'];
        $platform = $course_data['platform'];
        $subject_area = $course_data['subject_area'];
        $registration_code = $course_data['registration_code'];


        // Get instructors that teach this course. $course_id must be defined above for this script.
        include 'features/get-instructors.php'; // Script will initialize $instructors array,
        // an array of associative arrays which hold instructor_id, and display_name.

        // Get students that are enrolled in this course. $course_id must be defined above for this script.
        include 'features/get-students.php'; // Script will initialize $students array,
        // an array of associative arrays which hold student_id, and display_name.


        // TODO: Handle errors

        // For this course_id, get the projects

        // Query projects table to find projects with course_id as the course_fk
        $get_projects = mysqli_query($db, "SELECT * FROM projects WHERE course_fk = '$course_id'");



        $projects = array();
          // Get course id of courses
        if (mysqli_num_rows($get_projects) > 0) {

          //echo print_r(mysqli_fetch_assoc($get_projects));

            $project_info = array();
            while($row = mysqli_fetch_assoc($get_projects)) {
              $project_info['project_id'] = $row['project_id'];
              $project_info['title'] = $row['title'];

              $projects[] = $project_info;
            };
        };




        // Display Title
        echo "<h3>$title</h3>
          <div>";

        //Allows instructor to delete courses
        /*echo "<h3>$title<a onclick='removePanel(this)' style='float:right'>X</a></h3>
          <div>"*/

        if (count($instructors) > 1) {
          $instructor_label = 'Instructors:';
        } else {
          $instructor_label = 'Instructor:';
        }

        // Display instructors
        echo "<section><h4><label>$instructor_label</label> ";

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
              <h4>Course Projects</h4>
              <div id='project-list'>
                  <ul class='list-group'>";

        // Display projects
        if (empty($projects)) {
          echo "This course has no projects.";
        } else {
          foreach ($projects as $project) {
            //$course_id = $project['course_fk'];
            $project_id = $project['project_id'];
            $title = $project['title'];


            echo "<a href='instructor-project.php?project_id=$project_id&course_id=$course_id'><li class='list-group-item'>$title</li> </a>";
          }
        }
            echo "</ul>
              </div>
        <br />
          <a href='instructor-add-project.php?course_id=$course_id' class='btn btn-info' role='button' id='add-new-group'>Create New Project</a>
    </section>
    <br />

      <section id='student-course-list'>
          <h4>Students</h4>
          <div id='student-list'>
              <ul class='list-group'>";

              // Display students
              if (empty($students)) {
                echo "There are no students enrolled in this course.";
              } else {
                foreach ($students as $student) {
                  $name = $student['name'];
                  $display_name = $student['display_name'];
                  if(!$display_name){
                    echo "<li class='list-group-item'>$name</li>";
                  } else{
                    echo "<li class='list-group-item'>$display_name</li>";
                  }

                }
              }

              echo "</ul>
          </div>
      </section>
      <br />

      <b id='registration-code'>Student Registration Code: $registration_code</b>

      <br><br>

      <a href='features/download.php?id=$course_id&type=course' class='btn btn-info' role='button' id='view-course-attachments'>Download Course Attachments</a>


      <script type='text/javascript'>
        <!--
           function getConfirmation(){
              var retVal = confirm('Are you sure you want to delete this course?');
              if( retVal == true ){
                 window.location.replace('http://localhost/groupstart/views/features/delete-course.php?id=$course_id&rA=0');
                 return true;
              }
              else{
                 return false;
              }
           }
        //-->
     </script>

      <button  class='btn btn-info pull-right' style='color:black' id='remove-course'><span class='glyphicon glyphicon-trash' onclick='getConfirmation();'></span></button>

      </div>";
        }

      }
    ?>
  </div><br>
    <a href="instructor-add-course.php" class="btn btn-info" role="button" id="add-new-course">Add New Course</a>
      </div>

</body>
</html>
