<?php



 ?>


<html>


    <head>
        <?php
            include 'features/authentication.php';
            include 'features/instructor-authentication.php';
            include 'features/banner.php'
            ?>

        <link rel="stylesheet" type="text/css" href="../css/style.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

                <!-- Optional theme -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

                    <!-- Latest compiled and minified JavaScript -->
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

                    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
                    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
                    <script type="text/javascript" src="../js/instructor-project.js"></script>
                    <script src="../js/modal.js"></script>


                    </head>


    <body>
        <?php echo $banner ?>
        <?php
            include '../config/connection.php';
            include 'features/instructor-get-courses-data.php';

            $project_id = $_GET['project_id'];
            $course_id = $_GET['course_id'];
            $pgid = $_GET['pgid'];


            $get_project_info = mysqli_query($db, "SELECT * FROM projects WHERE project_id = '$project_id'");

            if(!$get_project_info ){
                die('Could not get data: ' . mysql_error());
            };

            $title = $description = $group_importance_statement = $min_group_size = $max_group_size = $group_form_algorithm = "";

            while($row = mysqli_fetch_assoc($get_project_info)){
                $title = $row['title'];
                $description = $row['description'];
                $group_importance_statement = $row['group_importance_statement'];
                $min_group_size = $row['min_group_size'];
                $max_group_size = $row['max_group_size'];
                $group_form_algorithm = $row['group_form_algorithm'];
            };




            // Get Deliverables for this project
            $deliverables = array();

            $get_deliverables = mysqli_query($db, "SELECT * FROM project_deliverables WHERE project_fk = '".$project_id."'");

            if (mysqli_num_rows($get_deliverables) > 0) {

              while ($row = mysqli_fetch_assoc($get_deliverables)) {
                $deliverable = array();
                $deliverable['project_deliverable_id'] = $row['project_deliverable_id'];
                $deliverable['title'] = $row['title'];
                $deliverable['description'] = $row['description'];
                $deliverable['due_date'] = $row['due_date'];
                $deliverables[] = $deliverable;
              }
            }

            // Add communication tool and link
            if (isset($_POST['add-deliverable-submit'])) {

              $title = $_POST['title'];
              $description = $_POST['description'];
              $due_date = $_POST['due-date'];


              // Insert into communications table.
              $insert = "INSERT INTO `project_deliverables` (`project_deliverable_id`, `project_fk`, `title`, `description`, `due_date`)
              VALUES (NULL, '$project_id', '$title', '$description', '$due_date')";

              $retval = mysqli_query($db, $insert); // performing mysql query

              if (!$retval) {
                // if data is not inserted into database return error
                die('Could not enter data given: '.mysqli_error($db));
              };

              header("Refresh: 0");
            }

        ?>


        <div class="container">
            <div class="row">
                <div class="col-md-8" id="project-info">
                    <div id="complete-add-project-process" class="section">
                                <div class="row">
                                    <div class="col-md-12" id="saved-proj-title">
                                        <h3>Project Title</h3>
                                        <p id="projTitle"><?php echo $title ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6" id="project-description">
                                                <h3>
                                                    Project Description
                                                </h3>
                                                <p id="projectDes">
                                                    <?php echo $description ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6" id="saved-impo-state">
                                                <h3>
                                                    Group Importance Statment
                                                </h3>
                                                <p id="statment-impo">
                                                    <?php echo $group_importance_statement ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row" id="saved-group-formation">
                                            <div class="col-md-12">
                                                <h3>
                                                    Group Formation Options
                                                </h3>


                                                <table class="table table-striped" id="saved-formation-options">
                                                    <thead>
                                                        <tr>
                                                            <th>Clustering options</th>
                                                            <th>Selected options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Clustering algorithm</td>
                                                            <td id="clustering-algo-selected-option"><?php echo $group_form_algorithm ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Minimum group size</td>
                                                            <td id="chosen-min-group-size"><?php echo $min_group_size ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Maximum group size</td>
                                                            <td id="chosen-max-group-size"><?php echo $max_group_size ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Variables to cluster by</td>
                                                            <td id="selected-variables"></td>
                                                        </tr>
                                                    </tbody>
                                                </table><br>
                                            </div>
                                            <div class="alert alert-info" role="alert" style="width:400px;float:left";>
                                                <strong>Reminder!</strong> If you change group size range remember to click the form student groups button again.
                                            </div>
                                            <button class="btn btn-info pull-right" id="edit-group-formation">change group size range</button>

                                                    <div id="myModal" class="modal">

                                                      <!-- Modal content -->
                                                      <div class="modal-content">
                                                        <span class="close">x</span>

                                                          <p hidden id="projectID"><?php echo $project_id?></p>
                                                          <p hidden id="courseID"><?php echo $course_id?></p>
                                                          <p hidden id="pgID"><?php echo $pgid?></p>
                                                        <form id="form-change-range" action="" method="POST">
                                                            <label for="minSize">minimum group size</label>
                                                            <input type="number" id="minSize" name="min_group_size" style="margin-bottom:10px;" min="2"><br>
                                                            <label for="maxSize">maximum group size</label>
                                                            <input type="number" id="maxSize" name="max_group_size" style="margin-bottom:20px;" min="2"><br>
                                                            <input class="btn btn-info" id="changeRange" type="button" value="make changes!" name="change_range" form="form-change-range"><br>
                                                          </form>



                                                </div>

                                            </div>
                                        </div>

                                        <?php

                                            $getAlgo = mysqli_query($db, "SELECT group_form_algorithm FROM projects WHERE project_id = $_GET[project_id]");

                                            if(!$getAlgo){
                                                die('Could not get data: ' . mysql_error());
                                            };

                                            $clustAlgo = "";

                                            while($row = mysqli_fetch_assoc($getAlgo)){
                                                $clustAlgo = $row['group_form_algorithm'];
                                            };

                                            if($clustAlgo == "Random Algorithm"){
                                                //group students with random algorithm
                                                echo "<a href='features/random_clustering.php?id=$project_id&cid=$course_id' class='btn btn-info btn-block'>Form student groups!</a><br>";
                                            } else{
                                                //echo "the algorithm you have chosen has not been implemented yet";
                                                echo "<a class='btn btn-info btn-block'>Form student groups!</a><br>";
                                            };

                                        ?>


                                        <div class="row">
                                            <div class="col-md-12">

                                                <h3>
                                                    Project Deliverables
                                                </h3>
                                                <div class="panel-group" id="accordion">
                                                    <div class="panel panel-default">

                                                <?php

                                                    if (empty($deliverables)) {
                                                      echo "<h5>There are no project deliverables at this time.</h5>";

                                                    } else {

                                                      for ($x = 0; $x < count($deliverables); $x++) { // For loop instead of foreach so we can use index for id of collapsible element

                                                        $deliverable = $deliverables[$x];

                                                        $date = new DateTime($deliverable['due_date']);
                                                        $date_format = date_format($date, "m/d/Y H:i:s");

                                                        echo "<div class='panel-heading clearfix deliverable'>
                                                        <div class='deliverable-heading'>
                                                          <div class-'deliverable-title'>
                                                            <h4 class='panel-title'>
                                                              <a data-toggle='collapse' data-parent='#accordion' href='#collapse$x'>$deliverable[title]</a>
                                                            </h4>
                                                          </div>
                                                          <div class='date-display'>
                                                            <label>Due Date:</label>
                                                            $date_format
                                                          </div>
                                                        </div>
                                                      </div>
                                                      <div id='collapse$x' class='panel-collapse collapse'>
                                                        <div class='panel-body sp'>
                                                        <label>Description:</label>
                                                        $deliverable[description] <br />
                                                        <a href='features/delete-deliverable.php?project_deliverable_id=$deliverable[project_deliverable_id]&project_id=$project_id&course_id=$course_id&pgid=$pgid' class='btn btn-default ' role='button'>Delete Deliverable</a>
                                                      </div>
                                                    </div>";


                                                      }
                                                    }
                                                   ?>
                                                   <!-- TODO: Style this input section.-->
                                                   <form action="" method="POST" id="add-deliverable-form">

                                                        <input type="text" name="title" class="del-input" placeholder="Title">
                                                        <input type="text" name="description" class="del-input" placeholder="Description">
                                                        <input type="date" class="del-input" name="due-date" placeholder="Due Date">
                                                        <input type="submit" name="add-deliverable-submit" value="Add Deliverable" class="btn btn-info" style="float: right;" form="add-deliverable-form" id="add-deliverable-submit"/>
                                                   </form>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3" id="manage-group">
                    <div class="row">
                        <h3>Manage Groups</h3>
                        <div class="col-md-12" id="manage-group-panels">
                            <div id="tabs">
                                <?php
                                    $pgid = $_GET['pgid'];

                                    if($pgid != "none"){
                                        $pgid = str_replace('_fk',' ',$pgid);
                                        $pgarray =  explode(' ', $pgid);




                                    echo "<ul>";
                                        foreach($pgarray as $project_group => $project_group_id){
                                            echo "<li><a href='#".$project_group_id."'>". "Group ".$project_group."</a></li>";
                                        };
                                    echo "</ul>";



                                    foreach($pgarray as $project_group => $project_group_id){

                                        echo "<div id='".$project_group_id."'>";

                                            $getStudents = mysqli_query($db, "SELECT student_fk FROM project_group_students WHERE project_group_fk = '".$project_group_id."'");


                                            if(!$getStudents){
                                                die('Could not get data: ' . mysql_error());
                                            } else{
                                                $students_id = array();

                                                while($row = mysqli_fetch_assoc($getStudents)){
                                                    $students_id[] = $row['student_fk'];
                                                };

                                                //print_r($students_id);

                                                foreach($students_id as $key => $id){

                                                    //echo $id . PHP_EOL;

                                                    $get_student_name = mysqli_query($db,"SELECT name FROM students WHERE student_id = $id ");


                                                    if(!$get_student_name){
                                                        die('Could not get data: ' . mysql_error());
                                                    } else{

                                                        $student = "";

                                                        while($row = mysqli_fetch_assoc($get_student_name)){
                                                            $student = $row['name'];
                                                        };
                                                        echo "<li>". $student ."</li>";
                                                    }

                                                }
                                            }
                                        echo "</div>";

                                    }


                                    } else{

                                        echo "<ul>";
                                        echo "<li><a href='#nogroups'>No Group</a></li>";
                                        echo "</ul>";

                                        echo "<div id=nogroups>No groups have been formed for this project yet.</div>";

                                    }


                                ?>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <h3>View other Projects</h3>
                        <div class="col-md-12">
                            <div id='project-list-inpro'>
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

                                                    // TODO: use the project_id to pass the url
                                                    echo "<a href='instructor-project.php?project_id=$project_id&course_id=$_GET[course_id]'><li class='list-group-item'>$title</li> </a>";
                                                }
                                            };

                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
