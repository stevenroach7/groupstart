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
                                                
                                               
                                                
                                                    
                                            
                                           
                                        <div class="row">
                                            <div class="col-md-12" style="margin-bottom:50px">
                                                <h3>
                                                    Group Charter Options
                                                </h3>
                                                <p>
                                                Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
                                                </p>

                                            </div></div>
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
                                        
                    
                                        <!--div class="row" id="add-deliverables">
                                            <a class="btn btn-info btn-block">Add project deliverables for students</a>
                                        </div-->




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
                                        
                                    }
                                    
                                        echo "</div>";
                                    } else{
                                        
                                        echo "<ul>";
                                        echo "<li><a href='#nogroups'>No Group</a></li>";
                                        echo "</ul>";
                                        
                                        echo "<div id=nogroups>No groups have been formed for this project yet.</div>";
                                        
                                    }
                                    
                                    
                                ?>
                            </div>
                            <!--div id="tabs">
                                <ul>
                                    <li><a href="#a">Tab A</a></li>
                                    <li><a href="#b">Tab B</a></li>
                                    <li><a href="#c">Tab C</a></li>
                                    <li><a href="#d">Tab D</a></li>
                                </ul>
                                <div id="a"><p>Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                                <div id="b"><p>In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                                <div id="c"><p> Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                                <div id="d"><p> Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus.</p></div>
                            </div-->
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
                    <div class="row">
                        <div class="col-md-12">
                          <!--?php
                            echo "<a href='features/download.php?id=$project_id&type=project' class='btn btn-info' role='button' id='view-project-attachments'>Download Project Attachments</a>";
                          ?-->
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </body>
</html>
