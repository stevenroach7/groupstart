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
  </head>

  <body>
    <?php echo $banner ?>
    <?php
       // script to change student name.
      include '../config/connection.php';

      // TODO: Figure out best way to display messages.
      if (isset($_POST['change-name-submit'])) { // Check if submit is pressed

         if (empty($_POST['name'])) { // check if name field is empty
           echo "Name field cannot be blank.";
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
     ?>



    <div class="container">
        <?php
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
                <div class="list-group"id='course-manage-list'>

                  <?php
                    if (empty($courses_data)) {
                      echo "<h3>You are not enrolled in any courses.</h3>";
                    } else {

                      foreach($courses_data as $course_data) {
                        $title = $course_data['title'];
                        echo "<a class='list-group-item clearfix'>$title
                          <span class='pull-right'>
                            <button class='btn btn-xs btn-info'>Leave Course</button>
                          </span>
                        </a>";

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
