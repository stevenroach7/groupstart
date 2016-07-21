
<html>

  <head>
    <?php
      include 'features/authentication.php';
      include 'features/instructor-authentication.php';
      include 'features/banner.php';
    ?>

      <link rel="stylesheet" type="text/css" href="../css/style.css" />

    <script src="../js/dropzone.min.js"></script>

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



 //$con = mysql_connect("localhost", "root", "", "REUdata");

  /*if (!$con)
  {
    die('Could not connect: ' . mysql_error());
  };*/
    
  //mysql_select_db("REUdata", $db);
 

        $title = $description = $platform = $subject_area = "";

        if(isset($_POST['submit'])){
            //echo "submit button has been clicked";
                if(empty($_POST['title']) || (empty($_POST['description']))){
                //echo "You either forgot to put a course title or a course description.";
            }
            else{
                
                $title = $_POST['title'];
                 $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                $platform = $_POST['platform'];
                $subject_area = $_POST['subject_area'];
                
                
                $registration_code = trim($title);
                
                $query = "INSERT INTO courses (course_id, title, description, platform, subject_area, registration_code) VALUES (NULL, '$title', '$description', '$platform', '$subject_area', '$registration_code')";
                
                $retval = mysqli_query($db,$query);
                
                if(!$retval ) {
                    die('Could not enter data given: ' . mysql_error());
                }
    //echo "Entered data successfully\n";
                //header("Location: http://localhost/groupstart/views/instructor-courses.php");
        //exit;
                $str = preg_replace('/\s+/', '', $title);
                $strlen = strlen($str);
                $numtitle = "";
                
                for( $i = 0; $i <= $strlen; $i++ ) {
                    $char = substr($str, $i, 1 );
                    $numtitle .= ord($char);
                }
                
                $str = substr($str, 0, 4);
                $numtitle = substr($numtitle, 0 , 10);
                $strcon = mysqli_insert_id($db) . $str . $numtitle;
                
                //echo $strcon;
        
                
                $query2 = "UPDATE courses SET registration_code= CONCAT(LAST_INSERT_ID(), $numtitle) WHERE title = '$title'";
                    
                    $retval2 = mysqli_query($db,$query2);
    
    if(!$retval2 ) {
        $sql = "DELETE FROM courses WHERE title = '$title'";
        
        if (mysqli_query($db, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysql_error();
        };
        
        die('Could not input proper registration code for this course: ' . mysql_error());
    }
    //echo "Entered course data successfully\n";
                
                //echo "Now trying to update instrcutors_course table";
                
                
                $query3 = "INSERT into instructors_courses (instructor_course_id, course_fk, instructor_fk) VALUES(NULL, LAST_INSERT_ID(), '$instructor_id') ";
                
                $retval3 = mysqli_query($db,$query3);
                
                if(!$retval ) {
                    die('Could not update instructors_course_table: ' . mysql_error());
                }
                
                header("Location: http://localhost/groupstart/views/instructor-courses.php");


    //mysql_close($db);
            
    }
        };

      ?>
      <div class="container main-page-form">
          <h1>Add New Course</h1><br>
      <form action="" method="POST" id ="add-course-form">
          <h4>Course Name</h4>
          <input type="text" name="title"><br>
          <h4>Platform</h4>
          <input type="text" name="platform" ><br>
          <h4>Subject Area</h4>
          <input type="text" name="subject_area"><br><br>

          <h4>Short Course Description</h4>
          <textarea rows="4" cols="50" id="course-description" name="description"></textarea>
      </form><br>
          <h4>Course Attachments</h4>
           <form action="../php_scripts/upload.php" class="dropzone dz-clickable">
               <div class="dz-default dz-message">
                   <span>Drop files here to upload</span>
               </div>
          </form>
          <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">

          <input type="submit" name="submit" value="Add Course" class="btn btn-info" form="add-course-form" id="add-new-course"/><br>
          <!--a class="btn btn-info" role="button" form="add-course-form" name="submit" id="add-new-course">Add Course</a-->


          </div>

  </body>
</html>
