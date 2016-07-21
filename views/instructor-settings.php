<?php


 ?>


<html>


  <head>
    <?php
      include 'features/authentication.php';
      include 'features/instructor-authentication.php';
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

        // script to change instructor name.
        include '../config/connection.php';

        // TODO: Figure out best way to display messages.
        if (isset($_POST['change-name-submit'])) { // Check if submit is pressed

           if (empty($_POST['name'])) { // check if name field is empty
             echo "Name field cannot be blank.";
           } else { // name field is not empty
             $name = $_POST['name'];

             // TODO: Check for bad characters

             // Update session storage.
             $_SESSION['display_name'] = $name;
             $instructor_id = $_SESSION['instructor_id'];

             // Add updated name to database.

             $update_name = "UPDATE instructors SET display_name='$name' WHERE instructor_id = '$instructor_id'";

               if (mysqli_query($db, $update_name)) {
                   echo 'Record updated successfully';
               } else {
                   echo 'Error updating record: '.mysqli_error($db);
               }
           }
        };

       ?>
       <?php
        // script to display courses and allow instructors to end courses.

        // Get courses instructor teaches

        // Query students_courses table to get course id's
        $instructor_id = $_SESSION['instructor_id'];
        $get_courses = mysqli_query($db, "SELECT * FROM instructors_courses WHERE instructor_fk = '".$instructor_id."'");

          // Get course id of courses
        if (mysqli_num_rows($get_courses) > 0) {

            $course_ids = array();

            while($row = mysqli_fetch_assoc($get_courses)) {
              $course_ids[] = $row['course_fk'];
            }

            // Query courses table to get other course info for each course_id
            $courses_data = array();

            foreach ($course_ids as $course_id) {
              $get_course_info = mysqli_query($db, "SELECT * FROM courses WHERE course_id = '".$course_id."'");

              $course_info = array();
              // course_id is unique so there should be only one row returned.
              while($row = mysqli_fetch_assoc($get_course_info)) {
                $course_info['course_id'] = $row['course_id'];
                $course_info['title'] = $row['title'];
                $course_info['description'] = $row['description'];
                $course_info['platform'] = $row['platform'];
                $course_info['subject_area'] = $row['subject_area'];
                // Get instructors here
              }
              $courses_data[] = $course_info;
            }
        }


       ?>

      <div class="container">
        <?php
        include '../config/connection.php';

        $display_name = $_SESSION['display_name'];

        echo "<h1>$display_name</h1>";
        ?>
          <div class="row">
              <div class=col-md-12>
                  <div class="row" id="profile-area">
                    <div class="col-md-5" >
                      <div class="row" id="profile-pic">
                        <div class="col-md-12" >
                          <img src="images/placeholder.png" alt="profile picture" class="img-rounded"><br><br>
                          <button type="button" class="btn btn-block btn-default">Change Profile Picture</button><br>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="row" id="profile-info">
                        <div class="col-md-12">
                          <div class="row" id="section1">
                            <div class="col-md-12">
                              <?php
                              $email = $_SESSION['email'];
                              echo "<h2>$email</h2>";
                              ?>

                            </div>
                          </div>
                          <div class="row" id="section2">
                            <div class="col-md-12">
                              <div id="change-pw">
                                <a href="features/change-password.php" class="btn btn-primary btn-block" role="button">Change Password</a>
                                <p>If you are signed on through Google or Facebook, please use those services to change your password.</p>
                              </div>
                            </div>
                          </div>
                        <div class="row" id="section3">

                        </div>
                        <div class="row" id="section4">
                          <div class="col-md-12">
                            <form method="POST" action="instructor-settings.php" id="change-name-form">
                              <div class="col-md-7">
                                <div id="fn"><p>Display Name:</p>
                                  <?php
                                  echo "<input type='text' name='name' placeholder=\"$display_name\" form='change-name-form'>";
                                  ?>
                                </div>
                              </div>
                              <div class="col-md-5">
                                <br />
                                <div id="change-name">
                                  <input type="submit" class="btn btn-primary btn-block" name="change-name-submit" value="Change Display Name" form="change-name-form">
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                  <div class="list-group"id='course-manage-list'>

                    <?php
                      if (empty($courses_data)) {
                        echo "<h3>You are not teaching any courses.</h3>";
                      } else {

                        foreach($courses_data as $course_data) {
                          $title = $course_data['title'];
                          echo "<a class='list-group-item clearfix'>$title
                            <span class='pull-right'>
                              <button class='btn btn-xs btn-info'>End Course</button>
                            </span>
                          </a>";

                        }
                      }
                    ?>

                  </div>
                </div>
              </div>
            </div>

  </body>
</html>
