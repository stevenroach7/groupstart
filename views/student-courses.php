<?php

  // Require composer autoloader
  require(__DIR__ . '/../vendor/autoload.php');

use Auth0\SDK\Auth0;

$auth0 = new Auth0(array(
    'domain'        => 'grouplens.auth0.com',
    'client_id'     => 'bCtvXMfHvtJH650uSGQ0K6N1RjPGK0RW',
    'client_secret' => 'NpHPjNmtZjQQVnGeQvbbdRqwdAcit3KutB4RM0XoqO_K5Pgr1mK0DG0XRK3IaL15',
    'redirect_uri'  => 'http://localhost/groupstart/views/student-courses.php'
));


    $userInfo = $auth0->getUser();

    if (!$userInfo) {
        //echo("Prob");
        // We have no user info
        // redirect to Login
    } else {
        //echo("TGRSVD");
        // User is authenticated
        // Say hello to $userInfo['name']
        // print logout button
        // start sessions maybe

    }





  $courses = ['Introduction to Computer Science', 'User Interface Design'];



 ?>


<html>
    <?php include 'features/banner.php' ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="../js/accordion_functionality.js"></script>

    <script src="http://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

  <head>
    <?php echo $banner ?>
      
    <div><h2>Welcome <?php echo $userInfo['name']?></h2> </div>

  </head>

  <body>

    <div class="container" id="instructor-course-list">
        <h1>List of Courses</h1>

    <div id='accordion'>
    <?php foreach ($courses as $course) { // Loop only makes accordion for the first one since it is id and not class.

      echo "<h3>$course</h3>
        <div>
          <section id='course-decription'><h4>Course Description</h4>
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
              Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet
              quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et
              sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.
              Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui.
              Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque
              egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor,
              facilisis luctus, metus
              </p>
            </section>
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
            </section><br>

            <button id='view-course-attachments'>View course attachments</button>

        </div>";

    }
    ?>
    </div>
         <!-- <a href="instructor-add-course.php" class="btn btn-info" role="button" id="add-new-course">Add New Course</a> -->
        <!--button id="add-new-course" type="button" class="btn btn-default">Add New Course</button-->
      <form method="post" action="student-courses.php">
        <h2>Add New Course</h2>
        <input type="text" name="registration-code" placeholder="Enter Course Registration Code">
        <input type="submit" name="student-add-course" value="Submit">
      </form>
    </div>














  </body>
</html>
