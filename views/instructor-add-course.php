
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
        include('../config/connection.php');

 $con = mysql_connect("localhost", "root", "", "REUdata");

  if (!$con)
  {
    die('Could not connect: ' . mysql_error());
  };
    
  mysql_select_db("REUdata", $con);

        $title = $description = "";
        
        if(isset($_POST['submit'])){
            //echo "submit button has been clicked";
                if(empty($_POST['title']) || (empty($_POST['description']))){
                //echo "one or more of the fields are empty";
            }
            else{
                $title = $_POST['title'];
                 $description = $_POST['description'];
                
                $query = "INSERT INTO courses (course_id, title, description, platform, subject_area, registration_code) VALUES (NULL, '$title', '$description', NULL, NULL, '54321')";
                
                $retval = mysql_query( $query, $con );
    
    if(! $retval ) {
      die('Could not enter data: ' . mysql_error());
    }
    //echo "Entered data successfully\n";

  mysql_close($con);       
            }
    };
      
      ?>
      <div class="container main-page-form">
          <h1>Add New Course</h1>
      <form  action="" method="POST" id ="add-course-form">
          <h4>Course Name</h4>
          <input type="text" name="title" value="<?php echo $title;?>">

          <h4>Short Course Description</h4>
          <textarea rows="4" cols="50" id="course-description" name="description"><?php echo $description;?></textarea><br>
      </form>
          <h4>Course Attachments</h4>
           <form action="../php_scripts/upload.php" class="dropzone dz-clickable">
               <div class="dz-default dz-message">
                   <span>Drop files here to upload</span>
               </div>
          </form>
          <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">

          <input type="submit" name= "submit" value="Add Course" class="btn btn-info" form="add-course-form" id="add-new-course"/><br>
          <!--a class="btn btn-info" role="button" form="add-course-form" name="submit" id="add-new-course">Add Course</a-->


          </div>

  </body>
</html>


