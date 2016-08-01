<?php



 ?>


<html>


  <head>
    <?php
      include 'features/authentication.php';
      include 'features/student-authentication.php';
      include 'features/banner.php';
    ?>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

      <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

      <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script type="text/javascript" src="../js/student-start-project.js"></script>

  </head>

  <body>
      <?php echo $banner ?><br>
      <?php
         include '../config/connection.php';

          $project_id = $_GET['project_id'];

          $get_project_info = mysqli_query($db, "SELECT * FROM projects WHERE project_id = '$project_id'");

          if(!$get_project_info ){
            die('Could not get data: ' . mysql_error());
          };

          $title = $description = $group_importance_statement = "";

          while($row = mysqli_fetch_assoc($get_project_info)){
            $title = $row['title'];
            $description = $row['description'];
            $group_importance_statement = $row['group_importance_statement'];
          };



      ?>
      <div class="container">
          <div class="row" >
              <div class="col-md-8" id="student-need-read">
                <h1><?php echo $title ?></h1><br>
              <div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">

        <input type="checkbox" id="read-descrip" disabled> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#project-descrip">Group Project Description</a>
      </h4>
    </div>
    <div id="project-descrip" class="panel-collapse collapse in clearfix">
      <div class="panel-body"><p><?php echo $description?></p></div><br>
        <button type="button" class="btn btn-info center-block" id="check-description">I have read and understood the project description.</button><br>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <input type="checkbox" id="read-statement" disabled> &nbsp;<a data-toggle="collapse" data-parent="#accordion" href="#group-impo-statement">Group Importance Statement</a>
      </h4>
    </div>
    <div id="group-impo-statement" class="panel-collapse collapse clearfix">
      <div class="panel-body"><p><?php echo $group_importance_statement?></p></div><br>
        <button type="button" class="btn btn-info center-block" id="check-statement">I have read and understood the group importance statement.</button><br>
    </div>
  </div>
</div>
  <a href="student-cluster-form.php" class="btn btn-info btn-block" role="button" id="student-form-group">Go to Group Formation Step</a>

</div>
              <div class="col-md-4">
                <h3 style="text-align:center;">Other projects avaliable in this course</h3><br>
                  <div id='view-other-projects'>
                                <ul class='list-group'>

                                    <?php

                                        // Query projects table to find projects with course_id
                                        $get_projects = mysqli_query($db, "SELECT * FROM projects WHERE course_fk = $_GET[course_id]");
                                        //echo print_r(mysqli_fetch_assoc($get_projects));

                                        $projects = array();
                                        // Get course id of courses
                                        if (mysqli_num_rows($get_projects) > 0) {


                                            $project_info = array();

                                            while($row = mysqli_fetch_assoc($get_projects)) {

                                                $project_info['project_id'] = $row['project_id'];
                                                $project_info['title'] = $row['title'];
                                                $projects[] = $project_info;
                                            };
                                        };

                                            // Display projects
                                            if (empty($projects)) {
                                                echo "This course has no projects.";
                                            } else {
                                                foreach ($projects as $project) {
                                                    $project_id = $project['project_id'];
                                                    $title = $project['title'];
                                                    echo "<a href='student-start-project.php?project_id=$project_id&course_id=$_GET[course_id]'><li class='list-group-item'>$title</li> </a>";
                                                }
                                            };

                                    ?>
                                </ul>
                            </div>


              </div>
          </div>
      </div>

  </body>
</html>
