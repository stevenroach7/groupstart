<?php



 ?>


<html>
  <link rel="stylesheet" type="text/css" href="../css/style.css" />

  <head>

  </head>


  <body>
      <h1>Add New Course</h1>
      <div class=main-page-form>
      <form id ="add-course-form">
          <h4>Course Name</h4><input type="text" name="course-name">
          
          <h4>Short Course Description</h4><br>
          <textarea rows="4" cols="50" name="course-description"></textarea><br>
          
          <h4>Course Attachments</h4>
          
      </form>
           <form action="../php_scripts/upload.php" class="dropzone"></form>
          <input type="submit" value="Add Course">
          
         
          </div>

  </body>
</html>
