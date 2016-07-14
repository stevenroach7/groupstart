<?php



 ?>


<html>
  
    

  <head>
      <?php include 'features/banner.php' ?>
      
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
      
      <div class="container main-page-form">
          <h1>Add New Course</h1>
      <form id ="add-course-form">
          <h4>Course Name</h4>
          <input type="text" name="course-name">
          
          <h4>Short Course Description</h4>
          <textarea rows="4" cols="50" id="course-description" name="course_description"></textarea><br>   
      </form>
          <h4>Course Attachments</h4>
           <form action="../php_scripts/upload.php" class="dropzone dz-clickable">
               <div class="dz-default dz-message">
                   <span>Drop files here to upload</span>
               </div>
          </form>
          <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
          
          <!--input type="submit" value="Add Course"-->
          <a href="instructor-courses.php" class="btn btn-info" role="button" id="add-new-course">Add Course</a>
          
         
          </div>

  </body>
</html>
