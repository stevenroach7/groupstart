<?php


 ?>


<html>


  <head>
    <?php
      include 'features/authentication.php';
      include 'features/student-authentication.php';
      include 'features/banner.php';
      include 'features/student-get-courses-data.php'; // Gets $courses_data array.
    ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css" />

    <script src="../js/dropzone.min.js"></script>

  </head>

  <body>
    <?php echo $banner ?>
    <?php

      include '../config/connection.php';

      include 'features/alert.php';

      // script to change student name.
      if (isset($_POST['change-name-submit'])) { // Check if submit is pressed

       if (empty($_POST['name'])) { // check if name field is empty
         alertUser('Name field cannot be blank.');
       } else { // name field is not empty
         $display_name = $_POST['name'];

         // TODO: Check for bad characters. Check to make sure name is appropriate.

         // Update session storage.
         $_SESSION['display_name'] = $display_name;
         $student_id = $_SESSION['student_id'];

         // Add updated name to database.

         $update_name = "UPDATE students SET display_name='$display_name' WHERE student_id='$student_id'";

         if (mysqli_query($db, $update_name)) {
             echo 'Record updated successfully';
         } else {
             echo 'Error updating record: '.mysqli_error($db);
         }
       }
      };

      // Script to change profile pic.
      if (isset($_POST['change-pic-submit'])) {


        $file_size = $_FILES["pic-upload"]["size"];
        $file_tmp = $_FILES['pic-upload']['tmp_name'];
        $file_name = $_FILES['pic-upload']['name'];
        $file_type = $_FILES['pic-upload']['type'];

        $file_valid = 1;

        // Check file size
        if ($file_size > 1000000) { // 1 Megabyte
         alert('Sorry, only files smaller than 1 Megabyte are allowed.');
         $file_valid = 0;
        } elseif (!$file_size > 0) { // 1 Megabyte
         alertUser('Invalid file uploaded.');
         $file_valid = 0;
        }
        // Allow certain file formats
        if ($file_type != 'image/png') {
          alertUser('You must submit a png image.');
          $file_valid = 0;
        }

        if ($file_valid) {
          // file upload validation check.
          $target_dir = '../uploads/';
          $target_file = $target_dir.basename($file_name);

          if (move_uploaded_file($file_tmp, $target_file)) {

            $file = mysqli_real_escape_string($db, file_get_contents($target_file));

            $upload_pic = "UPDATE students SET profile_pic = '$file' WHERE student_id = '$student_id'";


            $retval = mysqli_query($db, $upload_pic);

            if (!$retval) {
              echo mysqli_error($db);
              die('Could not enter data given: '.mysqli_error($db));
            }
           } else {
             echo 'Sorry, there was an error uploading your file.';

           }
        }
      }






     ?>



    <div class="container">
        <?php
        $display_name = $_SESSION['display_name'];
        $student_id = $_SESSION['student_id'];
        echo "<h1>$display_name</h1>";
        ?>
        <div class="row">
            <div class=col-md-12>
                <div class="row" id="profile-area">
                  <div class="col-md-5" >
                    <div class="row" id="profile-pic">
                      <div class="col-md-12" >
                        <?php

                          $get_prof_pic = "SELECT * FROM students WHERE student_id = $student_id";
                          $sth = $db->query($get_prof_pic);
                          $result=mysqli_fetch_array($sth);
                          echo '<img src="data:image/png;base64,'.base64_encode( $result['profile_pic'] ).'" alt="Image not found" onError="this.onerror=null;this.src=\'images/placeholder.png\';" class="img-rounded prof-pic">';

                        ?>

                        <br><br>
                        <form action="" method="POST" id="upload-pic" enctype="multipart/form-data">
                          <span>Upload a new profile picture: </span><input type="file" name="pic-upload" id="pic-upload"> <br />
                          <input type="submit" name="change-pic-submit" value="Upload Picture" class="btn btn-block btn-default" form="upload-pic"/><br>
                        </form>

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
                          <form method="POST" action="student-settings.php" id="change-name-form">
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
              <h3>Courses</h3>

                <div class="list-group"id='course-manage-list'>

                  <?php
                    if (empty($courses_data)) {
                        echo '<h3>You are not enrolled in any courses.</h3>';
                    } else {

                      // Filter out inactive courses.
                      $courses_data = array_filter($courses_data, function($v) { return $v['active'] == 1; });

                      foreach ($courses_data as $course_data) {
                          $title = $course_data['title'];
                          echo "<a class='list-group-item clearfix'>$title

                      </a>";

                      // <span class='pull-right'>
                      //   <button class='btn btn-xs btn-info'>Leave Course</button>
                      // </span>
                      }
                    }
                  ?>
                  </a>
                </div>
              </div>
            </div>

          </div>


  </body>
</html>
