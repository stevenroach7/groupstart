
<html>

    <head>
        <?php
            include 'features/authentication.php';
            include 'features/instructor-authentication.php';
            include 'features/banner.php';
            ?>

        <link rel="stylesheet" type="text/css" href="../css/style.css" />

        <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script>
                tinymce.init({
                             selector: "#course-description"
                             });
                </script>

            </head>


    <body>

        <?php echo $banner ?>

        <?php
            include '../config/connection.php';
            include 'features/instructor-get-courses-data.php';
            include 'features/alert.php';



            $title = $description = $platform = $subject_area = ''; //initializing variables for database fields

            // TODO: Handle errors and malicious input.

            if (isset($_POST['submit'])) { //checks if the add project button has been clicked

              // check if file uploads are valid.
              $files_valid = 1; // Boolean
              $files_uploaded = 0; // Integer count

              foreach ($_FILES['file-uploads']['tmp_name'] as $key => $tmp_name) {

                $file_size = $_FILES['file-uploads']['size'][$key];
                $file_tmp = $_FILES['file-uploads']['tmp_name'][$key];
                $file_type = $_FILES['file-uploads']['type'][$key];

                if (is_uploaded_file($file_tmp)) {

                  $files_uploaded += 1;

                  // Check file size
                  if ($file_size > 1000000) { // 1 Megabyte
                      alertUser('Sorry, only files smaller than 1 Megabyte are allowed.');
                      $files_valid = 0;
                  } elseif (!$file_size > 0) { // 1 Megabyte
                      alertUser('Invalid file uploaded .');
                      $files_valid = 0;
                  }

                  // Allow certain file formats
                  if ($file_type != 'application/pdf') {
                      alertUser('Sorry, only PDF files are allowed.');
                      $files_valid = 0;
                  }
                }
              }

              if (empty($_POST['title']) || (empty($_POST['description']))) {
                  //checking that required fields in form is filled
                alertUser('You either forgot to put a course title or a course description.');
              } elseif ($files_valid === 0) {

              } else {

                //setting initialized variables to values entered by user

                $title = $_POST['title'];
                  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                  $platform = $_POST['platform'];
                  $subject_area = $_POST['subject_area'];
                  $registration_code = trim($title); //sets registration_code as title for first insert

                //mysql query to insert values into respective fields
                $query = "INSERT INTO courses (course_id, title, description, platform, subject_area, registration_code) VALUES (NULL, '$title', '$description', '$platform', '$subject_area', '$registration_code')";

                  $retval = mysqli_query($db, $query);//performing mysql query

                if (!$retval) {
                    //if data is not inserted into database return error
                  die('Could not enter data given: '.mysql_error());
                };

                  $course_id = mysqli_insert_id($db);

                //function to create unique registration code for specific course
                $str = preg_replace('/\s+/', '', $title);//removes all spaces in title
                $strlen = strlen($str);
                  $numtitle = '';//variable for numeric representation for course title

                for ($i = 0; $i <= $strlen; ++$i) {
                    $char = substr($str, $i, 1);
                    $numtitle .= ord($char);
                };

                  $numtitle = substr($numtitle, 0, 10);//gets  a subtring of lenght 10 of numeric representation of course title

                //$str = substr($str, 0, 4);
                //$strcon = mysqli_insert_id($db) . $str . $numtitle;

                //mysql query to update registration_code of recently inserted data so that it equals numtitle
                //$query2 = "UPDATE courses SET registration_code= CONCAT(LAST_INSERT_ID(), $numtitle) WHERE course_id = '$course_id'";
                $query2 = "UPDATE courses SET registration_code= CONCAT($course_id, $numtitle) WHERE course_id = '$course_id'";

                  $retval2 = mysqli_query($db, $query2); //performing mysql query

                if (!$retval2) { // if update does not work then delete data where registration_code is the title
                  $sql = "DELETE FROM courses WHERE registration_code = '$title'";

                    if (mysqli_query($db, $sql)) {
                        //checking if delete was successful
                    echo 'Record deleted successfully';
                    } else {
                        echo 'Error deleting record: '.mysql_error();
                    };

                    die('Could not input proper registration code for this course: '.mysql_error());
                };

                //mysql query to update instrutors_course table
                $query3 = "INSERT INTO instructors_courses (instructor_course_id, course_fk, instructor_fk) VALUES (NULL, LAST_INSERT_ID(), '$instructor_id') ";

                  $retval3 = mysqli_query($db, $query3);

                  if (!$retval) {
                      die('Could not update instructors_course_table: '.mysql_error());
                  };



                  if ($files_uploaded > 0) {

                    foreach ($_FILES['file-uploads']['tmp_name'] as $key => $tmp_name) {
                      $file_name = $_FILES['file-uploads']['name'][$key];
                      $file_size = $_FILES['file-uploads']['size'][$key];
                      $file_tmp = $_FILES['file-uploads']['tmp_name'][$key];
                      $file_type = $_FILES['file-uploads']['type'][$key];

                      // file upload validation check.
                      $target_dir = '../uploads/';
                      $target_file = $target_dir.basename($file_name);

                      if (move_uploaded_file($file_tmp, $target_file)) {
                          echo 'The file '.basename($file_name).' has been uploaded.';

                          $file = mysqli_real_escape_string($db, file_get_contents($target_file));

                          $upload_file = "INSERT INTO attachments (attachment_id, file, file_name, file_type, file_size, course_fk) VALUES (NULL, '$file', '$file_name', '$file_type', '$file_size', '$course_id')";

                          $retval = mysqli_query($db, $upload_file);

                          if (!$retval) {
                              echo mysqli_error($db);
                              die('Could not enter data given: '.mysqli_error($db));
                          }
                      } else {
                          echo 'Sorry, there was an error uploading your file.';
                      }
                    }
                  }
                  header('Location: http://localhost/groupstart/views/instructor-courses.php'); //once all queries are done relocate to instructor-course page
              };
            };

            ?>


      <div class="container main-page-form">

        <h1>Add New Course</h1><br>

        <form action="instructor-add-course.php" method="POST" id="add-course-form" enctype="multipart/form-data">
          <h4>Course Name</h4>
          <input type="text" name="title"><br>
          <h4>Platform</h4>
          <input type="text" name="platform" ><br>
          <h4>Subject Area</h4>
          <input type="text" name="subject_area"><br><br>
          <h4>Short Course Description</h4>
          <textarea rows="4" cols="50" id="course-description" name="description"></textarea>
          <br>


          <h4>Course Attachments</h4>
          <label>Upload PDF's (Each file must be smaller than 1 Megabyte):</label><input type="file" name="file-uploads[]" id="file-upload" multiple="" />
          <br />

          <input type="submit" name="submit" value="Add Course" class="btn btn-info" form="add-course-form" id="add-new-course"/><br>
        </form>


      </div>

    </body>
</html>
