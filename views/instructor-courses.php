<?php



  session_start();

  $_SESSION['loggedin'] = true; // TODO: Change this so that users aren't logged in if they go directly to this page. 
  $_SESSION['type'] = 'instructor';




  $courses = ['Introduction to Computer Science', 'User Interface Design'];

 ?>



<head>
  <?php
    include 'features/authentication.php';
    include 'features/banner.php'
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

<div class="container" id="instructor-course-list">
    <h1 style="text-align:center">List of Courses</h1>
    <!-- <h2 style="text-align:center">Welcome <?php echo $instructorInfo['name']?></h2><br> -->

    <div id='accordion'>
    <?php foreach ($courses as $course) { // Loop only makes accordion for the first one since it is id and not class.

      echo "<h3>$course</h3>
        <div>
    <section id='course-decription'><h4>Course Description</h4>
    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p></section>
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
    ?>
    </div><br>
         <!-- <a href="instructor-add-course.php" class="btn btn-info" role="button" id="add-new-course">Add New Course</a> -->
        <!--button id="add-new-course" type="button" class="btn btn-default">Add New Course</button-->
    <a href="instructor-add-course.php" class="btn btn-info" role="button" id="add-new-course">Add New Course</a>
      </div>





</body>
</html>
