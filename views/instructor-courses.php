
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
  <?php echo $banner ?>

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

    // Check if instructor is teaching courses or not
    if (empty($courses_data)) {
      echo "<h1>You are not currently teaching any courses.";

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
      </section>
        <section id='course-projects'>
            <h4>Course Projects</h4>
            <div id='project-list'>
                <ul class='list-group'>
                    <a href='instructor-project.php'><li class='list-group-item'>First item</li> </a>
                          <a href='instructor-project.php'><li class='list-group-item'>Second item</li></a>
                          <a href='instructor-project.php'><li class='list-group-item'>Third item</li></a>
                          <a href='instructor-project.php'><li class='list-group-item'>First item</li></a>
                          <a href='instructor-project.php'><li class='list-group-item'>Second item</li></a>
                          <a href='instructor-project.php'><li class='list-group-item'>Third item</li></a>
                </ul>
            </div>
            <br />
              <a href='instructor-add-project.php' class='btn btn-info' role='button' id='add-new-group'>Create New Project</a>
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

        <b>Student registraion code: 123ABC</b>

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
